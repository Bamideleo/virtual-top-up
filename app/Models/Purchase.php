<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_name',
        'type',
        'status',
        'amount',
        'transaction_id',
        'date',
        'pin',
        'serialNumber',
        'phone_number',
        'real_amount',
        'token',
        'units',
        'customerAddress',
        'phase',
        'customerName',
        'purchase_code',
    ];

}
