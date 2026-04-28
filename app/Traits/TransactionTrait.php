<?php

namespace App\Traits;

use App\CentralLogics\helpers;
use App\Models\EMoney;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

trait TransactionTrait
{
    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }


    /**
     * Customer with Customer
     * Sender [ -($amount+$send_money_charge) ]
     * Receiver (+$amount)
     * Admin (+$send_money_charge)
     */
    public function customer_send_money_transaction(int $from_user_id, int $to_user_id, float $amount, float $charge, ?string $note = null): ?string
    {
        $total_amount = $amount + $charge;

        return DB::transaction(function () use ($from_user_id, $to_user_id, $amount, $charge, $total_amount, $note) {
            /** From user's(customer) debit */
            $senderEmoney = EMoney::where('user_id', $from_user_id)->first();
            $senderEmoney->current_balance -= $total_amount;
            $senderEmoney->save();

            $primary_transaction = Transaction::create([
                'user_id' => $from_user_id,
                'ref_trans_id' => null, //since primary
                'transaction_type' => SEND_MONEY,
                'debit' => $amount,
                'credit' => 0,
                'charge' => $charge,
                'balance' => $senderEmoney->current_balance,
                'from_user_id' => $from_user_id,
                'to_user_id' => $to_user_id,
                'note' => null,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);

            //send notification
            Helpers::send_transaction_notification($from_user_id, $amount, SEND_MONEY);

            /** To user's(customer) credit */
            $ReceiverEmoney = EMoney::where('user_id', $to_user_id)->first();
            $ReceiverEmoney->current_balance += $amount;
            $ReceiverEmoney->save();

            Transaction::create([
                'user_id' => $to_user_id,
                'ref_trans_id' => $primary_transaction->transaction_id,
                'transaction_type' => RECEIVED_MONEY,
                'debit' => 0,
                'credit' => $amount,
                'balance' => $ReceiverEmoney->current_balance,
                'from_user_id' => $from_user_id,
                'to_user_id' => $to_user_id,
                'note' => $note,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);
            //send notification
            Helpers::send_transaction_notification($to_user_id, $amount, RECEIVED_MONEY);

            /** Admins' credit (send money charge) */
            $adminEmoney = EMoney::where('user_id', Helpers::get_admin_id())->first();
            $adminEmoney->charge_earned += $charge;
            $adminEmoney->save();

            Transaction::create([
                'user_id' => $from_user_id,
                'ref_trans_id' => $primary_transaction->transaction_id,
                'transaction_type' => ADMIN_CHARGE,
                'debit' => 0,
                'credit' => $charge,
                'balance' => $adminEmoney->charge_earned,
                'from_user_id' => $from_user_id,
                'to_user_id' =>  Helpers::get_admin_id(),
                'note' => null,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);

            return $primary_transaction->transaction_id ?? null;
        });
    }

    /**
     * Customer with Agent
     * Customer [ -($amount+$cash_out_charge) ]
     * Agent (+$amount)
     * Agent (+$agent_commission_from_cash_out_charge)
     * Admin (+$cash_out_charge_without_agent_commission)
     */
    public function customer_cash_out_transaction(int $from_user_id, int $to_user_id, float $amount, float $charge, ?string $note = null): ?string
    {
        $total_amount = $amount + $charge;

        $agent_commission = Helpers::get_agent_commission($charge);

        return DB::transaction(function () use ($from_user_id, $to_user_id, $amount, $charge, $total_amount, $note, $agent_commission) {
            /** From user's(customer) debit */
            $customerEmoney = EMoney::where('user_id', $from_user_id)->first();
            if ($customerEmoney->current_balance >= $total_amount) {
                $customerEmoney->current_balance -= $total_amount;
                $customerEmoney->save();
            } else {
                return null;
            }

            $primary_transaction = Transaction::create([
                'user_id' => $from_user_id,
                'ref_trans_id' => null, //since primary
                'transaction_type' => CASH_OUT,
                'debit' => $amount,
                'credit' => 0,
                'charge' => $charge,
                'balance' => $customerEmoney->current_balance,
                'from_user_id' => $from_user_id,
                'to_user_id' => $to_user_id,
                'note' => $note,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);
            //send notification
            Helpers::send_transaction_notification($from_user_id, $amount, CASH_OUT);

            /** To user's(agent) credit */
            $agentEmoney = EMoney::where('user_id', $to_user_id)->first();
            $agentEmoney->current_balance += $amount;
            $agentEmoney->save();

            Transaction::create([
                'user_id' => $to_user_id,
                'ref_trans_id' => $primary_transaction->transaction_id,
                'transaction_type' => CASH_IN,
                'debit' => 0,
                'credit' => $amount,
                'balance' => $agentEmoney->current_balance,
                'from_user_id' => $from_user_id,
                'to_user_id' => $to_user_id,
                'note' => $note,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);
            //send notification
            Helpers::send_transaction_notification($to_user_id, $amount, CASH_IN);

            /** To user's(agent commission) credit */
            $emoney = EMoney::where('user_id', $to_user_id)->first();
            $emoney->current_balance += $agent_commission;
            $emoney->save();

            Transaction::create([
                'user_id' => $to_user_id,
                'ref_trans_id' => $primary_transaction->transaction_id,
                'transaction_type' => AGENT_COMMISSION,
                'debit' => 0,
                'credit' => $agent_commission,
                'balance' => $emoney->current_balance,
                'from_user_id' => $from_user_id,
                'to_user_id' => $to_user_id,
                'note' => $note,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);

            /** Admins' credit */
            $adminEmoney = EMoney::where('user_id', Helpers::get_admin_id())->first();
            $adminEmoney->charge_earned += ($charge - $agent_commission);
            $adminEmoney->save();

            Transaction::create([
                'user_id' => Helpers::get_admin_id(),
                'ref_trans_id' => $primary_transaction->transaction_id,
                'transaction_type' => ADMIN_CHARGE,
                'debit' => 0,
                'credit' => ($charge - $agent_commission),
                'balance' => $adminEmoney->charge_earned,
                'from_user_id' => $from_user_id,
                'to_user_id' =>  Helpers::get_admin_id(),
                'note' => $note,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);

            return $primary_transaction->transaction_id ?? null;
        });
    }

    /**
     * Customer with Customer
     * Sender [ -($amount+$send_money_charge) ]
     * Receiver (+$amount)
     * Admin (+$send_money_charge)
     */
    public function customer_request_money_transaction(int $from_user_id, int $to_user_id, float $amount, float $charge, ?string $note = null): ?string
    {
        $total_amount = $amount + $charge;

        return DB::transaction(function () use ($from_user_id, $to_user_id, $amount, $charge, $total_amount, $note) {
            /** From user's(customer) debit */
            $senderEmoney = EMoney::where('user_id', $from_user_id)->first();
            if ($senderEmoney->current_balance >= $total_amount) {
                $senderEmoney->current_balance -= $total_amount;
                $senderEmoney->save();
            } else {
                return null;
            }

            $primary_transaction = Transaction::create([
                'user_id' => $from_user_id,
                'ref_trans_id' => null, //since primary
                'transaction_type' => SEND_MONEY,
                'debit' => $amount,
                'credit' => 0,
                'charge' => $charge,
                'balance' => $senderEmoney->current_balance,
                'from_user_id' => $from_user_id,
                'to_user_id' => $to_user_id,
                'note' => null,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);
            //send notification
            Helpers::send_transaction_notification($from_user_id, $total_amount, SEND_MONEY);

            /** To user's(customer) credit */
            $receiverEmoney = EMoney::where('user_id', $to_user_id)->first();
            $receiverEmoney->current_balance += $amount;
            $receiverEmoney->save();

            Transaction::create([
                'user_id' => $to_user_id,
                'ref_trans_id' => $primary_transaction->transaction_id,
                'transaction_type' => RECEIVED_MONEY,
                'debit' => 0,
                'credit' => $amount,
                'balance' => $receiverEmoney->current_balance,
                'from_user_id' => $from_user_id,
                'to_user_id' => $to_user_id,
                'note' => $note,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);
            //send notification
            Helpers::send_transaction_notification($to_user_id, $amount, RECEIVED_MONEY);

            /** Admins' (send money charge) credit */
            $adminEmoney = EMoney::where('user_id', Helpers::get_admin_id())->first();
            $adminEmoney->charge_earned += $charge;
            $adminEmoney->save();

            Transaction::create([
                'user_id' => Helpers::get_admin_id(),
                'ref_trans_id' => $primary_transaction->transaction_id,
                'transaction_type' => ADMIN_CHARGE,
                'debit' => 0,
                'credit' => $charge,
                'balance' => $adminEmoney->charge_earned,
                'from_user_id' => $from_user_id,
                'to_user_id' =>  Helpers::get_admin_id(),
                'note' => null,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);

            return $primary_transaction->transaction_id ?? null;
        });
    }

    /** ========= AGENT TRANSACTIONS ========= */

    /**
     * Agent with Customer
     * Agent (-$amount)
     * Customer (+$amount)
     */
    public function cash_in_transaction(int $from_user_id, int $to_user_id, float $amount): ?string
    {
        return DB::transaction(function () use ($from_user_id, $to_user_id, $amount) {
            /** From user's(agent) debit */
            $agentEmoney = EMoney::where('user_id', $from_user_id)->first();
            if ($agentEmoney->current_balance >= $amount) {
                $agentEmoney->current_balance -= $amount;
                $agentEmoney->save();
            } else {
                return null;
            }

            $primary_transaction = Transaction::create([
                'user_id' => $from_user_id,
                'ref_trans_id' => null, //since primary
                'transaction_type' => CASH_OUT,
                'debit' => $amount,
                'credit' => 0,
                'balance' => $agentEmoney->current_balance,
                'from_user_id' => $from_user_id,
                'to_user_id' => $to_user_id,
                'note' => null,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);
            //send notification
            Helpers::send_transaction_notification($from_user_id, $amount, CASH_OUT);

            /** To user's(customer) credit */
            $customerEmoney = EMoney::where('user_id', $to_user_id)->first();
            $customerEmoney->current_balance += $amount;
            $customerEmoney->save();

            Transaction::create([
                'user_id' => $to_user_id,
                'ref_trans_id' => $primary_transaction->transaction_id,
                'transaction_type' => CASH_IN,
                'debit' => 0,
                'credit' => $amount,
                'balance' => $customerEmoney->current_balance,
                'from_user_id' => $from_user_id,
                'to_user_id' => $to_user_id,
                'note' => null,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);
            //send notification
            Helpers::send_transaction_notification($to_user_id, $amount, CASH_IN);

            return $primary_transaction->transaction_id ?? null;
        });
    }


    /** ========= ADD TRANSACTIONS ========= */

    /**
     * Admin with Customer
     * Admin (-$amount)
     * Admin (-$bonus)
     * Customer [ +($amount+$bonus) ]
     */
    public static function add_money_transaction(int $from_user_id /**admin user id*/, int $to_user_id /**agent or customer user id*/, float $amount): ?string
    {
        $user_info = User::find($to_user_id);
        $user_type = $user_info->type == 1 ? 'agent' : ($user_info->type == 2 ? 'customer' : null);
        $bonus = Helpers::get_add_money_bonus($amount, $to_user_id, $user_type);
        $total_amount = $amount + $bonus;

        return DB::transaction(function () use ($from_user_id, $to_user_id, $amount, $bonus, $total_amount) {
            /** From user's(admin) debit */
            $emoney = EMoney::where('user_id', $from_user_id)->first();
            if ($emoney->current_balance >= $amount) {
                $emoney->current_balance -= $amount;
                $emoney->save();
            } else {
                return null;
            }

            $primary_transaction = Transaction::create([
                'user_id' => $from_user_id,
                'ref_trans_id' => null, //since primary
                'transaction_type' => SEND_MONEY,
                'debit' => $amount,
                'credit' => 0,
                'balance' => $emoney->current_balance,
                'from_user_id' => $from_user_id,
                'to_user_id' => $to_user_id,
                'note' => null,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);

            /** From user's(admin) debit */
            if ($bonus > 0) {
                $emoney = EMoney::where('user_id', $from_user_id)->first();
                if ($emoney->current_balance >= $bonus) {
                    $emoney->current_balance -= $bonus;
                    $emoney->save();
                } else {
                    return null;
                }

                Transaction::create([
                    'user_id' => $from_user_id,
                    'ref_trans_id' => $primary_transaction->transaction_id,
                    'transaction_type' => EXPENSE,
                    'debit' => $bonus,
                    'credit' => 0,
                    'balance' => $emoney->current_balance,
                    'from_user_id' => $from_user_id,
                    'to_user_id' => $to_user_id,
                    'bonus_id' => helpers::get_applied_add_money_bonus($amount, $to_user_id, 'customer')->id ?? null,
                    'note' => null,
                    'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
                ]);
            }

            /** To user's(customer) credit */
            $emoney = EMoney::where('user_id', $to_user_id)->first();
            $emoney->current_balance += $amount;
            $emoney->save();

            Transaction::create([
                'user_id' => $to_user_id,
                'ref_trans_id' => $primary_transaction->transaction_id,
                'transaction_type' => ADD_MONEY,
                'debit' => 0,
                'credit' => $amount,
                'balance' => $emoney->current_balance,
                'from_user_id' => $from_user_id,
                'to_user_id' => $to_user_id,
                'note' => null,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);

            /** To user's(customer) credit */
            if ($bonus > 0) {
                $emoney = EMoney::where('user_id', $to_user_id)->first();
                $emoney->current_balance += $bonus;
                $emoney->save();

                Transaction::create([
                    'user_id' => $to_user_id,
                    'ref_trans_id' => $primary_transaction->transaction_id,
                    'transaction_type' => ADD_MONEY_BONUS,
                    'debit' => 0,
                    'credit' => $bonus,
                    'balance' => $emoney->current_balance,
                    'from_user_id' => $from_user_id,
                    'to_user_id' => $to_user_id,
                    'note' => null,
                    'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
                ]);
            }

            //send notification
            $transaction_type = $bonus > 0 ?  ADD_MONEY_BONUS : ADD_MONEY;
            Helpers::send_transaction_notification($to_user_id, $total_amount, $transaction_type);

            return $primary_transaction->transaction_id ?? null;
        });
    }

    /** ========= Withdraw TRANSACTIONS ========= */

    /**
     * Admin with Customer
     * Customer [ -($amount+$charge) ]
     * Admin (+$amount)
     * Admin (+$charge)
     */
    public function accept_withdraw_transaction(int $receiver_user_id, float $amount, float $charge): void
    {
        $admin_user_id = User::where('type', 0)->first()->id;

        $total_amount = $amount + $charge;

        DB::transaction(function () use ($admin_user_id, $receiver_user_id, $amount, $charge, $total_amount) {
            //CUSTOMER TRANSACTION
            $userEmoney = EMoney::where('user_id', $receiver_user_id)->first();
            if ($userEmoney->pending_balance >= $total_amount) {
                $userEmoney->pending_balance -= $total_amount;
                $userEmoney->save();
            }

            $primary_transaction = Transaction::create([
                'user_id' => $receiver_user_id,
                'ref_trans_id' => null,
                'transaction_type' => WITHDRAW,
                'debit' => $amount,
                'credit' => 0,
                'charge' => $charge,
                'balance' => $userEmoney->current_balance,
                'from_user_id' => $receiver_user_id,
                'to_user_id' => $admin_user_id,
                'note' => null,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);

            //ADMIN TRANSACTION (amount)
            $adminEmoney = EMoney::where('user_id', $admin_user_id)->first();
            $adminEmoney->current_balance += $amount;
            $adminEmoney->save();

            Transaction::create([
                'user_id' => $admin_user_id,
                'ref_trans_id' => $primary_transaction['transaction_id'],
                'transaction_type' => WITHDRAW,
                'debit' => 0,
                'credit' => $amount,
                'balance' => $adminEmoney->current_balance,
                'from_user_id' => $receiver_user_id,
                'to_user_id' => $admin_user_id,
                'note' => null,
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);

            //ADMIN TRANSACTION (commission)
            if ($charge > 0) {
                $account = EMoney::where('user_id', $admin_user_id)->first();
                $account->charge_earned += $charge;
                $account->save();

                Transaction::create([
                    'user_id' => $admin_user_id,
                    'ref_trans_id' => $primary_transaction['transaction_id'],
                    'transaction_type' => ADMIN_CHARGE,
                    'debit' => 0,
                    'credit' => $charge,
                    'balance' => $account->charge_earned,
                    'from_user_id' => $receiver_user_id,
                    'to_user_id' => $admin_user_id,
                    'note' => null,
                    'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
                ]);
            }
        });
    }

    public function disputeTransaction(string $ref_transaction_id, int $dispute_claimed_user_id, int $disputed_user_id, float $amount): void
    {
        DB::transaction(function () use ($ref_transaction_id, $dispute_claimed_user_id, $disputed_user_id, $amount) {

            $admin_user_id = User::where('type', 0)->first()->id;

            $claimedUser = EMoney::where('user_id', $dispute_claimed_user_id)->first();
            $claimedUser->current_balance += $amount;
            $claimedUser->save();

            Transaction::create([
                'user_id' => $dispute_claimed_user_id,
                'ref_trans_id' => $ref_transaction_id,
                'transaction_type' => ADDED_DISPUTE_MONEY,
                'debit' => 0,
                'credit' => $amount,
                'balance' => $claimedUser->current_balance,
                'from_user_id' => $admin_user_id,
                'to_user_id' => $dispute_claimed_user_id,
                'note' => 'Refund received due to dispute',
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);

            $disputedUser = EMoney::where('user_id', $disputed_user_id)->first();
            $disputedUser->current_balance -= $amount;
            $disputedUser->save();

            Transaction::create([
                'user_id' => $disputed_user_id,
                'ref_trans_id' => $ref_transaction_id,
                'transaction_type' => DEDUCTED_DISPUTE_MONEY,
                'debit' => $amount,
                'credit' => 0,
                'balance' => $disputedUser->current_balance,
                'from_user_id' => $disputed_user_id,
                'to_user_id' => $admin_user_id,
                'note' => 'Amount reversed due to dispute',
                'transaction_id' => Str::random(5) . Carbon::now()->timestamp,
            ]);
        });
    }
}
