<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseProductVariation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'lot_no', 'product_id', 'variation_id', 'qty', 'return_qty',
    ];
}
