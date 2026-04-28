<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class PaymentRequest extends Model
{
    use HasUuid;

    protected $table = 'payment_requests';
}
