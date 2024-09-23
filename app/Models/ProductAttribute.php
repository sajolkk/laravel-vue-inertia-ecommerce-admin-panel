<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'product_id',
        'variation_id',
        'status',
        'user_id',
        'delete_user',
    ];
}
