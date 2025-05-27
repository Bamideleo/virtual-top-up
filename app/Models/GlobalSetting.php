<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'site_name',
        'site_logo',
        'description',
        'phone_number',
        'description',
        'email'
    ];

}
