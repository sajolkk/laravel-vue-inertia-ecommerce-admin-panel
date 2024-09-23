<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSerial extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'lot_no', 'product_id', 'variation_id', 'product_serial', 'qty', 'return_qty', 'status'
    ];
}
