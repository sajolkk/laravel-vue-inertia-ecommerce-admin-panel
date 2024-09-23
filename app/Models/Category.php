<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'category_name',
        'slug',
        'status',
        'parent_id',
        'user_id',
        'delete_user',
    ];

    protected static function booted()
    {
        static::creating(function ($category) {
            $category->user_id = Auth::user()->id;
            $category->created_at = now();
            $category->slug = $category->GenerateSlug($category->category_name);
        });
        static::updating(function ($category) {
            $category->user_id = Auth::user()->id;
            $category->updated_at = now();
        });
    }

    // generate slug from input category name
    private function GenerateSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::whereCategoryName($name)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    // category user
    // which user creted the category
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // active category product 
    public function products()
    {
        return $this->hasMany(Product::class)->where('status', 1);
    }
}
