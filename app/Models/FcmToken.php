<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FcmToken extends Model
{
    use HasFactory;
    protected $fillable = ['admin_id','customer_id','app_token', 'web_token', 'topic_name'];
}
