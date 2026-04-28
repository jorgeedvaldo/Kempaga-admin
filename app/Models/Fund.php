<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Fund extends Model
{
    protected $casts = [
        'user_id' => 'integer',
        'amount' => 'float:4',
        'payment_method' => 'string',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
