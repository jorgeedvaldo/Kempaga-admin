<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    protected $casts = [
        'user_id' => 'integer',
        'transaction_id' => 'string',
        'ref_trans_id' => 'string',
        'transaction_type' => 'string',
        'debit' => 'float:4',
        'credit' => 'float:4',
        'charge' => 'float:4',
        'balance' => 'float:4',
        'from_user_id' => 'integer',
        'to_user_id' => 'integer',
        'bonus_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'amount' => 'float:4',
    ];

    protected $fillable = [
        'user_id',
        'ref_trans_id',
        'transaction_type',
        'debit',
        'credit',
        'credit',
        'charge',
        'balance',
        'from_user_id',
        'to_user_id',
        'bonus_id',
        'note',
        'transaction_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeNotAdmin(Builder $query): Builder
    {
        return $query->whereHas('user', function ($q) {
            $q->where('type', '!=', 0);
        });
    }

    public function scopeAgent(Builder $query): Builder
    {
        return $query->whereHas('user', function ($q) {
            $q->where('type', 1);
        });
    }

    public function scopeCustomer(Builder $query): Builder
    {
        return $query->whereHas('user', function ($q) {
            $q->where('type', 2);
        });
    }

    public function scopeMerchant(Builder $query): Builder
    {
        return $query->whereHas('user', function ($q) {
            $q->where('type', 3);
        });
    }

    public function dispute(): HasOne
    {
        return $this->hasOne(Dispute::class);
    }
}
