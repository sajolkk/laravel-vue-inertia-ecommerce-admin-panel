<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PcBuilderComponent extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'required',
        'min_qty',
        'max_qty',
        'component_type',
        'status',
        'order',
        'delete_user',
    ];

    // 
    function category()
    {
        return $this->belongsTo(Category::class);
    }
}
