<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'question',
        'answare',
        'sender_name',
        'email',
        'reply_by',
        'reply_time',
        'status',
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id','product_id');
    }
}
