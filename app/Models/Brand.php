<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'mysql';
    protected $primaryKey = 'brand_id';
    protected $fillable = [
        'brand_name',
        'slug',
        'image',
        'status',
        'user_id',
        'delete_user',
    ];

    protected static function booted(){
        static::creating(function($brand){
            $brand->user_id = Auth::user()->id;
            $brand->slug = $brand->GenerateSlug($brand->brand_name);
            $brand->created_at = now();
        });
    }

    // generate slug from input category name
    private function GenerateSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::whereBrandName($name)->latest('brand_id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }

    // 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getAllBrand(){
        return Brand::where('status',1)->orderBy('brand_name')->get();
    }

    // brand product
    public function product()
    {
    	return $this->hasMany(Product::class);
    }
}
