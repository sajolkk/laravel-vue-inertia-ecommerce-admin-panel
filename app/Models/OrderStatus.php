<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_status',
        'processing_status',
        'picked_status',
        'shipped_status',
        'delivered_status',
        'confirm_status',
        'payment_time',
        'processing_time',
        'picked_time',
        'shipped_time',
        'delivered_time',
        'confirm_time',
    ];

    protected $primaryKey = 'order_id';
}
