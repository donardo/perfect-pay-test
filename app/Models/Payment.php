<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $casts = [
        'payment_data' => 'array',
        'amount' => 'decimal:2',
    ];

}
