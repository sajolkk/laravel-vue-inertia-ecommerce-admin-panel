<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariation extends Model
{
	use HasFactory, SoftDeletes;
	protected $fillable = [
		'product_id',
		'variation_id',
		'status',
		'user_id',
		'original_price',
		'sale_price',
		'regular_price',
		'discount',
		'stock_qty',
		'delete_user',
	];

	// product variation has many relation
	public function variation()
	{
		return $this->belongsTo(Variation::class, 'variation_id', 'variation_id')
			->leftjoin('variation_categories', 'variation_categories.variation_category_id', 'variations.variation_category_id')
			->select('variations.variation_id', 'variation_categories.variation_category_name', 'variations.variation_name');
	}
}
