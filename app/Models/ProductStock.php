<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'purchase_qty',
        'stock_qty',
        'return_qty',
        'damage_qty',
    ];

    public function product()
    {
    	return $this->belongsTo(Product::class,'product_id','product_id');
    }
}
