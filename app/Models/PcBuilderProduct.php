<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PcBuilderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'pc_builder_id',
        'pc_builder_component_id',
        'product_id',
        'variation_id',
        'qty',
    ];

    function pcBuilder()
    {
        return $this->belongsTo(PcBuilder::class);
    }
}
