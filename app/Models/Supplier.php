<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'user_id',
        'delete_user',
    ];

    protected static function booted()
    {
        static::creating(function ($supplier) {
            $supplier->user_id = Auth::user()->id;
        });
        
        static::updating(function ($supplier) {
            $supplier->user_id = Auth::user()->id;
        });
        
    }

    // 
    public function purchases()
    {
        return $this->hasMany(PurchaseMaster::class);
    }
}
