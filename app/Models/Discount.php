<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;


    protected $fillable = [
        'discount',
        'code',
        'expire_at',
        'coupon_amt'
    ];

    
}
