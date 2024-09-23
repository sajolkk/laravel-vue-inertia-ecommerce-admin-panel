<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseMaster extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'lot_no',
        'supplier_id',
        'invoice_no',
        'invoice_date',
        'total_amount',
        'discount',
        'grand_amount',
        'due_amount',
        'status',
        'user_id',
        'paid_amount',
        'delete_user',
    ];

    protected static function booted()
    {
        static::creating(function ($purchase) {
            $purchase->user_id = Auth::user()->id;
            $purchase->status = 0;
            $purchase->discount = 0;
            $purchase->grand_amount = $purchase->total_amount;
        });

        static::updating(function ($purchase) {
            $purchase->user_id = Auth::user()->id;
        });
    }

    public function details()
    {
        return $this->hasMany(PurchaseDetail::class, 'lot_no', 'lot_no')
            ->with('variationProducts')
            ->join('products', 'purchase_details.product_id', 'products.product_id')
            ->join('brands', 'products.brand_id', 'brands.brand_id')
            ->select('purchase_details.*', 'products.product_name', 'products.product_unit', 'brands.brand_name');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getStatusToStringAttribute()
    {
        if ($this->status) {
            return '<span class="bg-success p-1 rounded">Approved</span>';
        } else {
            return '<span class="bg-warning p-1 rounded">Pending</span>';
        }
    }
}
