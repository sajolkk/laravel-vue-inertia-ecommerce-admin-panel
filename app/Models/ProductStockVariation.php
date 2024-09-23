<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStockVariation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'variation_id',
        'purchase_qty',
        'stock_qty',
        'return_qty',
        'damage_qty',
    ];
}
