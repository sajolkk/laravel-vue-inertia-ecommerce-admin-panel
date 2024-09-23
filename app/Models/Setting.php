<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'address',
        'phone',
        'email',
        'termsConditions',
        'refundReturnPolicy',
        'onlineDelivery',
        'privacyPolicy',
        'aboutUs',
        'emi_terms',
        'facebook',
        'youtube',
        'linkedin',
        'twitter',
        'google_playstore',
        'apple_store',
    ];
}
