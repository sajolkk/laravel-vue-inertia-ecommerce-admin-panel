<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'product_id', 'variation_id', 'image', 'thumbnail_image', 'status', 'user_id','delete_user',
    ];

}
