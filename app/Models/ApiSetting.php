<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'public_key',
        'secret_key',
        'type',
        'api_key',
        'contact_code',
        'email',
        'password'
    ];
}
