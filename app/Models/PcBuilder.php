<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PcBuilder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'customer_id',
    ];

    function components()
    {
        return $this->hasMany(PcBuilderProduct::class)
            ->leftJoin('products', 'pc_builder_products.product_id', '=', 'products.product_id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.brand_id')
            ->leftJoin('variations', 'pc_builder_products.variation_id', '=', 'variations.variation_id')
            ->leftJoin('variation_categories', 'variations.variation_category_id', '=', 'variation_categories.variation_category_id')
            ->select('pc_builder_products.*', 'products.product_name', 'brands.brand_name', 'variations.variation_name', 'variation_categories.variation_category_name');
    }
}
