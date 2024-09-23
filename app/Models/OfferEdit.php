<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferEdit extends Model
{
    use HasFactory;
    protected $primaryKey = 'edit_id';
    protected $fillable = [
        'offer_id',
        'title',
        'slug',
        'start_from',
        'end_to',
        'conditions',
        'offer_type',
        'offer_details',
        'image',
        'promo_code',
        'min_amount',
        'total_discount',
        'status',
        'slider_status',
        'user_id',
        'edit_user',
    ];
}
