<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfferProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['offer_id', 'product_id', 'free_product_id', 'discount'];

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->created_at = now();
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'offer_id');
    }
}
