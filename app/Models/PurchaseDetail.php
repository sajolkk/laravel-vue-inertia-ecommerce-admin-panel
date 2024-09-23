<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'lot_no',
        'product_id',
        'qty',
        'unit_price',
        'total_price',
        'return_qty',
        'discount',
    ];


    // variation products
    public function variationProducts()
    {
        return $this->hasMany(PurchaseProductVariation::class, 'lot_no', 'lot_no')
            ->join('product_variations', 'purchase_product_variations.variation_id', 'product_variations.variation_id')
            ->join('variation_categories', 'product_variations.variation_id', 'variation_categories.variation_category_id')
            ->join('variations', 'product_variations.variation_id', 'variations.variation_id')
            // ->select('product_variations.*','variation_categories.variation_category_name','variations.variation_name');
            ->select('purchase_product_variations.*', 'variation_categories.variation_category_name', 'variations.variation_name');
    }
}
