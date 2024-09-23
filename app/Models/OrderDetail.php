<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'variation_id',
        'qty',
        'return_qty',
        'discount',
        'sale_price',
        'total_amount',
        'warranty',
        'word_warranty',
        'offer_id',
        'emi_sale_price',
        'total_emi_amount',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function product_serials()
    {
        return $this->hasMany(ProductSerial::class, 'product_id', 'product_id')->where('variation_id', $this->variation_id)->where('qty', '>', 0);
    }

    // get order product serials
    function orderProductSerials() {
        return $this->hasMany(OrderProductSerial::class, 'order_id','order_id')
        ->where('product_id', $this->product_id)->where('qty', '>', 0);
    }
}
