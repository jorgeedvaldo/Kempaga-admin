<?php

namespace App\Http\Controllers\Payment;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\EMoney;
use Illuminate\Http\Request;
use App\Models\PaymentRecord;
use App\CentralLogics\helpers;
use App\CentralLogics\SmsModule;
use App\Models\PhoneVerification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Modules\Gateways\Traits\SmsGateway;
use Stevebauman\Location\Facades\Location;

class PaymentOrderController extends Controller
{
    public function __construct(
        private EMoney            $eMoney,
        private PaymentRecord     $paymentRecord,
        private PhoneVerification $phoneVerification,
        private User              $user
    ){}

    public function paymentProcess(Request $request): View|RedirectResponse
    {
        $ip = env('APP_MODE') == 'live' ? $request->ip() : '61.247.180.82';
        $currentUserInfo = Location::get($ip);

        $paymentId = $request->payment_id;
        $paymentRecord = $this->paymentRecord->where(['id' => $paymentId])->first();
        if (isset($paymentRecord) && $paymentRecord->expired_at > Carbon::now()) {
            $merchantUser = $this->user->with('merchant')->where(['id' => $paymentRecord->merchant_user_id])->first();
            $logo=Helpers::get_business_settings('logo');
            $logo = Helpers::onErrorImage($logo, dynamicStorage(path: 'storage/app/public/business') . '/' . $logo, dynamicAsset(path: 'public/assets/admin/img/160x160/img2.jpg'), 'business/');
            return view('payment.phone', compact('paymentId', 'merchantUser', 'currentUserInfo', 'paymentRecord', 'logo'));
        }
        Toastr::warning(translate('Payment time expired'));
        return back();
    }

    public function sendOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'dial_country_code' => 'required|string',
            'phone' => 'required|min:8|max:20',
        ], [
            'phone.required' => translate('Phone is required'),
            'dial_country_code.required' => translate('Country code is required'),
        ]);

        $phone = $request->dial_country_code . $request->phone;
        $paymentId = $request->payment_id;
        $otpStatus = Helpers::get_business_settings('payment_otp_verification');

        $user = $this->user->where(['phone' => $phone, 'type' => CUSTOMER_TYPE])->first();
        if (!$user){
            Toastr::warning(translate('User not found with this phone number'));
            return back();
        }
        session()->put('user_phone', $user->phone);

        if (isset($otpStatus) && $otpStatus == 1) {
            $otp = mt_rand(1000, 9999);
            if (env('APP_MODE') != LIVE) {
                $otp = '1234';
            }

            if (isset($user)) {
                if ($user->is_kyc_verified != 1) {
                    Toastr::warning(translate('User is not verified, please complete your account verification'));
                    return back();
                }

                DB::table('phone_verifications')->updateOrInsert(['phone' => $phone], [
                    'otp' => $otp,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if (addon_published_status('Gateways')) {
                    $response = SmsGateway::send($request['phone'], $otp);
                } else {
                    $response = SmsModule::send($request['phone'], $otp);
                }

                Toastr::success(translate('OTP send !'));
                return redirect()->route('otp', compact('paymentId'));
            }
            Toastr::warning(translate('please enter a valid user phone number'));
            return back();
        }
        return redirect()->route('pin', compact('paymentId'));
    }

    public function otpIndex(Request $request): View
    {
        $paymentId = $request->paymentId;
        $paymentRecord = $this->paymentRecord->where(['id' => $paymentId])->first();
        $frontendCallback = $paymentRecord->callback;
        $logo=Helpers::get_business_settings('logo');
        $logo = Helpers::onErrorImage($logo, dynamicStorage(path: 'storage/app/public/business') . '/' . $logo, dynamicAsset(path: 'public/assets/admin/img/160x160/img2.jpg'), 'business/');
        return view('payment.otp', compact('paymentId', 'frontendCallback', 'logo'));
    }

    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => 'required|min:4|max:4',
        ], [
            'otp.required' => translate('OTP is required'),
            'otp.min' => translate('OTP must be 4 digit'),
            'otp.max' => translate('OTP must be 4 digit'),
        ]);

        $paymentId = $request->payment_id;
        $verify = $this->phoneVerification->where(['phone' => session('user_phone'), 'otp' => $request['otp']])->first();

        if (isset($verify)) {
            $verify->delete();
            Toastr::success(translate('OTP verify success !'));
            return redirect()->route('pin', compact('paymentId'));
        }

        Toastr::warning(translate('OTP verify failed !'));
        return back();
    }

    public function resendOtp(Request $request): JsonResponse
    {
        $phone = session('user_phone');

        try {
            $otp = mt_rand(1000, 9999);
            if (env('APP_MODE') != LIVE) {
                $otp = '1234';
            }
            DB::table('phone_verifications')->updateOrInsert(['phone' => $phone], [
                'otp' => $otp,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (addon_published_status('Gateways')) {
                $response = SmsGateway::send($phone, $otp);
            } else {
                $response = SmsModule::send($phone, $otp);
            }

            return response()->json(['message' => 'OTP Send'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'OTP Send failed'], 404);
        }
    }

    public function pinIndex(Request $request): View
    {
        $paymentId = $request->paymentId;
        $paymentRecord = $this->paymentRecord->where(['id' => $paymentId])->first();
        $frontendCallback = $paymentRecord->callback;
        $logo=Helpers::get_business_settings('logo');
        $logo = Helpers::onErrorImage($logo, dynamicStorage(path: 'storage/app/public/business') . '/' . $logo, dynamicAsset(path: 'public/assets/admin/img/160x160/img2.jpg'), 'business/');
        return view('payment.pin', compact('paymentId', 'frontendCallback', 'logo'));
    }

    public function verifyPin(Request $request): RedirectResponse
    {
        $request->validate([
            'pin' => 'required|min:4|max:4',
        ], [
            'pin.required' => translate('Pin is required'),
            'pin.min' => translate('Pin must be 4 digit'),
            'pin.max' => translate('Pin must be 4 digit'),
        ]);

        $paymentId = $request->payment_id;
        $user = $this->user->where(['phone' => session('user_phone'), 'type' => CUSTOMER_TYPE])->first();

        if (!isset($user)) {
            Toastr::warning(translate('user not found !'));
            return back();
        }

        if (!Hash::check($request->pin, $user->password)) {
            Toastr::warning(translate('pin mismatched !'));
            return back();
        }

        $paymentRecord = $this->paymentRecord->where(['id' => $paymentId, 'transaction_id' => null, 'is_paid' => 0])->first();

        if (isset($paymentRecord) && $paymentRecord->expired_at > Carbon::now()) {
            $amount = $paymentRecord->amount;
            $merchantUser = $this->user->where('id', $paymentRecord->merchant_user_id)->first();
            $adminUser = $this->user->where('type', 0)->first();
            $userEmoney = $this->eMoney->where('user_id', $user->id)->first();
            $merchantEmoney = $this->eMoney->where('user_id', $paymentRecord->merchant_user_id)->first();
            $adminEmoney = $this->eMoney->where('user_id', $adminUser->id)->first();

            if ($userEmoney->current_balance < $paymentRecord->amount) {
                Toastr::warning(translate('You do not have enough balance. Please add money.'));
                return back();
            }

            $transactionId = payment_transaction($user, $merchantUser, $userEmoney, $merchantEmoney, $amount, $adminUser, $adminEmoney);

            if ($transactionId != null) {
                $paymentRecord->user_id = $user->id;
                $paymentRecord->transaction_id = $transactionId;
                $paymentRecord->is_paid = 1;
                $paymentRecord->save();

                Toastr::success(translate('Payment successful !'));
                return redirect()->route('success', ['payment_id' => $request['payment_id']]);
            }
        }
        Toastr::warning(translate('Payment failed !'));
        return back();
    }

    public function successIndex(Request $request): View
    {
        $paymentId = $request->payment_id;
        return view('payment.success', compact('paymentId'));
    }

    public function paymentSuccessCallback(Request $request): RedirectResponse
    {
        $paymentRecord = $this->paymentRecord->where(['id' => $request->payment_id])->first();

        if (!isset($paymentRecord) || !$paymentRecord->callback) {
            return redirect('/');
        }

        $transactionId = $paymentRecord->transaction_id;
        $separator = str_contains($paymentRecord->callback, '?') ? '&' : '?';
        $url = $paymentRecord->callback . $separator . 'transaction_id=' . $transactionId;

        return redirect($url);
    }

    public function back_to_callback(Request $request): RedirectResponse
    {
        $paymentRecord = $this->paymentRecord->where(['id' => $request->payment_id])->first();

        if (!isset($paymentRecord) || !$paymentRecord->callback) {
            return redirect('/');
        }

        if ($paymentRecord->transaction_id) {
            $separator = str_contains($paymentRecord->callback, '?') ? '&' : '?';
            $url = $paymentRecord->callback . $separator . 'transaction_id=' . $paymentRecord->transaction_id;
        } else {
            $url = $paymentRecord->callback;
        }

        return redirect($url);
    }
}
