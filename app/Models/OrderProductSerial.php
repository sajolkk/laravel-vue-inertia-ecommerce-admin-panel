<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductSerial extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'lot_no',
        'product_id',
        'product_serial',
        'variation_id',
        'serial_id',
        'qty',
        'return_qty',
    ];
}
