<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    protected $fillable = ['phone', 'otp', 'expires_at'];

    // --- IGNORE ---
    // This model is used for storing OTP codes temporarily
    
}
