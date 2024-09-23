<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferEditProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'edit_id',
        'offer_id',
        'product_id',
        'free_product_id',
        'discount',
    ];
}
