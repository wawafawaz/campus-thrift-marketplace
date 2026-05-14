<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'buyer_id',
        'seller_id',
        'product_id',
        'amount',
        'payment_status',
        'transaction_status',
    ];
}