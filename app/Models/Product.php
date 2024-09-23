<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
	use HasFactory, SoftDeletes;
	protected $connection = 'mysql';
	protected $primaryKey = 'product_id';
	protected $fillable = [
		'product_id',
		'barcode',
		'category_id',
		'brand_id',
		'product_name',
		'product_model',
		'description',
		'specification',
		'slug',
		'product_unit',
		'variation_type',
		'product_type',
		'original_price',
		'sale_price',
		'regular_price',
		'discount',
		'warranty',
		'word_warranty',
		'status',
		'stock_status',
		'feature_pro_status',
		'hot_product',
		'thumbnail',
		'user_id',
		'stock_qty',
		'delete_user',
		'key_features',
		'per_month_emi',
		'emi_interest_rate',
		'total_emi',
		'total_month',
	];

	protected static function booted()
	{
		static::creating(function ($product) {
			$product->user_id = Auth::user()->id;
			$product->created_at = now();
			$product->slug = $product->GenerateSlug($product->product_name);
		});
		static::updating(function ($product) {
			$product->user_id = Auth::user()->id;
			$product->updated_at = now();
		});
	}

	// generate slug from input category name
	private function GenerateSlug($name)
	{
		if (static::whereSlug($slug = Str::slug($name))->exists()) {
			$max = static::whereProductName($name)->latest('id')->skip(1)->value('slug');
			if (isset($max[-1]) && is_numeric($max[-1])) {
				return preg_replace_callback('/(\d+)$/', function ($mathces) {
					return $mathces[1] + 1;
				}, $max);
			}
			return "{$slug}-2";
		}
		return $slug;
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function brand()
	{
		return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	// product variation has many relation
	public function variations()
	{
		return $this->hasMany(ProductVariation::class, 'product_id', 'product_id')
			->leftjoin('variations', 'variations.variation_id', 'product_variations.variation_id')
			->leftjoin('variation_categories', 'variation_categories.variation_category_id', 'variations.variation_category_id')
			->select('product_variations.*', 'variation_categories.variation_category_id', 'variation_categories.variation_category_name', 'variations.variation_name');
	}

	// product attributes has many relation
	public function attributes()
	{
		return $this->hasMany(ProductAttribute::class, 'product_id', 'product_id')
			->leftjoin('variations', 'variations.variation_id', 'product_attributes.variation_id')
			->leftjoin('variation_categories', 'variation_categories.variation_category_id', 'variations.variation_category_id')
			->select('product_attributes.*', 'variation_categories.variation_category_id', 'variation_categories.variation_category_name', 'variations.variation_name');
	}

	public function images()
	{
		return $this->hasMany(ProductImage::class, 'product_id', 'product_id')
			->leftjoin('variations', 'variations.variation_id', 'product_images.variation_id')
			->leftjoin('variation_categories', 'variation_categories.variation_category_id', 'variations.variation_category_id')
			->select('product_images.*', 'variation_categories.variation_category_name', 'variations.variation_name');
	}

	public function productImages()
	{
		$url = url('');
		return $this->hasMany(ProductImage::class, 'product_id', 'product_id')
			->leftjoin('variations', 'variations.variation_id', 'product_images.variation_id')
			->leftjoin('variation_categories', 'variation_categories.variation_category_id', 'variations.variation_category_id')
			->where('product_images.status', '!=', 0)
			->select('product_images.id', 'product_images.product_id', 'product_images.variation_id', DB::raw("CONCAT('$url/',product_images.image) as image"), 'variations.variation_name')
			->orderBy('product_images.status');
	}

	public function questions()
	{
		return $this->hasMany(Question::class, 'product_id', 'product_id')->latest();
	}

	public function reviews()
	{
		return $this->hasMany(Review::class, 'product_id', 'product_id')->latest();
	}

	public function product_variations()
	{
		return $this->hasMany(ProductVariation::class, 'product_id', 'product_id')->groupBy('variation_id');
	}

	function component_products()
	{
		$url = env('APP_URL');
		return $this->hasMany(ProductComponent::class, 'product_id', 'product_id')
			->leftJoin('products', 'product_components.component_product_id', 'products.product_id')
			->leftJoin('categories', 'products.category_id', 'categories.id')
			->leftJoin('brands', 'products.brand_id', 'brands.brand_id')
			->join('pc_builder_componets', 'products.category_id', 'pc_builder_componets.category_id')
			->where('pc_builder_componets.status', Status::ACTIVE)
			->select(
				'product_components.*',
				'products.category_id',
				'products.brand_id',
				'products.product_name',
				'products.product_model',
				'products.description',
				'products.specification',
				'products.slug',
				'products.product_unit',
				'products.variation_type',
				'products.product_type',
				'products.original_price',
				'products.sale_price',
				'products.regular_price',
				'products.discount',
				'products.warranty',
				'products.word_warranty',
				'products.status',
				'products.stock_status',
				'products.feature_pro_status',
				'products.hot_product',
				'products.thumbnail',
				DB::raw("CONCAT('$url/',products.thumbnail) as thumbnail"),
				'categories.category_name',
				'brands.brand_name',
				'pc_builder_componets.required',
				'pc_builder_componets.min_qty',
				'pc_builder_componets.max_qty',
				'pc_builder_componets.component_type',
			);
	}

	function components()
	{
		return $this->hasMany(ProductComponent::class, 'product_id', 'product_id');
	}
}
