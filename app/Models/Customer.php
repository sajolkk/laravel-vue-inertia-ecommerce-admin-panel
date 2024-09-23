<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $primaryKey ='customer_id';
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function shippingArea()
    {
        return $this->belongsTo(ShippingArea::class);
    }    

    protected $fillable = [
        'name', 'email', 'mobile', 'password','address','shipping_area_id','otp','token','verified_at',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];
}
