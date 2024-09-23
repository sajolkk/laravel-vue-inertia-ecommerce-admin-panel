<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'mobile',
        'email',
        'address',
        'district_id',
        'post_code',
    ];

    function shippingArea() {
        return $this->belongsTo(ShippingArea::class);
    }
}
