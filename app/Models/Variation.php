<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variation extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'mysql';
    protected $primaryKey = 'variation_id';
    protected $fillable = [
        'variation_category_id',
        'variation_name',
        'slug',
        'status',
        'user_id',
        'delete_user',
    ];

    protected static function booted(){
        static::creating(function($variation){
            $variation->user_id = Auth::user()->id;
            $variation->slug = $variation->GenerateSlug($variation->variation_name);
            $variation->created_at = now();
        });
    }

    // generate slug from input category name
    private function GenerateSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::where('variation_name',$name)->latest('variation_id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function variationCategory()
    {
        return $this->belongsTo(VariationCategory::class, 'variation_category_id', 'variation_category_id');
    }
    
}
