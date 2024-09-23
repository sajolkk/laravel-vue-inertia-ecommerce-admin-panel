<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Offer extends Model
{
    use HasFactory, SoftDeletes;
    protected $primarykey = 'offer_id';
    protected $fillable = [
        'title', 'slug', 'start_from', 'end_to', 'conditions', 'offer_type', 'offer_details', 'image', 'min_amount',
        'total_discount', 'promo_code', 'status', 'slider_status', 'user_id', 'delete_user',
    ];
    protected $casts = [
        'start_from' => 'datetime',
        'end_to' => 'datetime',
    ];


    protected static function booted()
    {
        static::creating(function ($offer) {
            $offer->user_id = Auth::user()->id;
            $offer->created_at = now();
        });
    }

    // offer products 
    public function products()
    {
        return $this->hasMany(OfferProduct::class, 'offer_id', 'offer_id')
            ->select('offer_products.*', 'products.product_name', 'products.sale_price', 'brands.brand_name')
            ->leftJoin('products', 'offer_products.product_id', 'products.product_id')
            ->leftJoin('brands', 'products.brand_id', 'brands.brand_id');
    }
}
