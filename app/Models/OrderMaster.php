<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderMaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'customer_id',
        'sub_total',
        'discount',
        'net_amount',
        'shipping_fee',
        'payment_type',
        'note',
        'invoice_by',
        'delivery_user',
        'delivery_method',
        'offer_id',
        'status',
        'cancel_note',
        'cancel_by',
        'cancel_time',
        'total_emi_amount',
        'per_month_emi',
        'paid_emi_amount',
    ];
    protected static function booted()
    {
        static::addGlobalScope('scopeStatus', function (Builder $builder) {
            $builder->with('orderStatus');
        });
    }


    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_id', 'order_id');
    }

    public function scopePendingOrder($query)
    {
        $query->whereNotIn('status', ['Cancel', 'Delivered']);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function order_products()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id')
            ->leftJoin('products', 'order_details.product_id', '=', 'products.product_id')
            ->select('products.*', 'order_details.*');
    }

    public function products()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id')
            ->leftJoin('products', 'order_details.product_id', '=', 'products.product_id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.brand_id')
            ->leftJoin('variations', 'order_details.variation_id', '=', 'variations.variation_id')
            ->leftJoin('variation_categories', 'variations.variation_category_id', '=', 'variation_categories.variation_category_id')
            ->select('order_details.*', 'products.product_name', 'products.product_unit', 'brands.brand_name', 'variations.variation_name', 'variation_categories.variation_category_name');
    }

    public function statusForm()
    {
        if (optional($this->orderStatus)->shipped_status == OrderStatus::DELIVERED_COMPLETED) {
            return null;
        }elseif (optional($this->orderStatus)->shipped_status == OrderStatus::SHIPPED_COMPLETED) {
            return '<form class="d-inline-block status-form" action="' . route("order.status", $this->order_id) . '" method="post" message="The ordered products have been delivered.">
                <input type="hidden" value="' . csrf_token() . '" name="_token" >
                <input type="hidden" value="PUT" name="_method" >
                <input type="hidden" name="status" value="'.OrderStatus::DELIVERED.'_status,1" >
                <button type="submit" class="btn btn-success py-1 mb-1 d-inline-block btn-sm" >
                    <i class="fas fa-people-carry"></i> Delivered
                </button>
            </form>';
        } else if (optional($this->orderStatus)->picked_status == OrderStatus::PICKED_COMPLETED) {
            return '<form class="d-inline-block status-form" action="' . route("order.status", $this->order_id) . '" method="post" message="The ordered products have been shipped.">
                <input type="hidden" value="' . csrf_token() . '" name="_token" >
                <input type="hidden" value="PUT" name="_method" >
                <input type="hidden" name="status" value="'.OrderStatus::SHIPPED.'_status,1" >
                <button type="submit" class="btn btn-primary py-1 mb-1 d-inline-block btn-sm" >
                    <i class="fas fa-shipping-fast"></i> Shipped
                </button>
            </form>';
        } else if (optional($this->orderStatus)->processing_status == OrderStatus::PROCESSING_COMPLETED) {
            return '<a href="'.route('order.invoice-create',$this->order_id).'" class="btn btn-info py-1 mb-1 d-inline-block btn-sm">
                    <i class="fas fa-file-invoice"></i> Invoice
                </a>';
        } else if (optional($this->orderStatus)->processing_status == OrderStatus::PROCESSING_PENDING) {
            return '<form class="d-inline-block status-form" action="' . route("order.status", $this->order_id) . '" method="post" message="The Order products are being processed.">
                <input type="hidden" value="' . csrf_token() . '" name="_token" >
                <input type="hidden" value="PUT" name="_method" >
                <input type="hidden" name="status" value="'.OrderStatus::PROCESSING.'_status,1" >
                <button type="submit" class="btn btn-info py-1 mb-1 d-inline-block btn-sm" >
                    <i class="fas fa-parking"></i> Processing
                </button>
            </form>';
        }
    }

    public function statusToString()
    {
        if ($this->status == OrderStatus::PLACED) {
            return '<span class="p-1 rounded bg-secondary">Placed</span>';
        } else if ($this->status == OrderStatus::PROCESSING) {
            return '<span class="p-1 rounded bg-secondary">Processing</span>';
        } else if ($this->status == OrderStatus::PICKED) {
            return '<span class="p-1 rounded bg-info">Picked</span>';
        } else if ($this->status == OrderStatus::SHIPPED) {
            return '<span class="p-1 rounded bg-success">Shipped</span>';
        } else if ($this->status == OrderStatus::DELIVERED) {
            return '<span class="p-1 rounded bg-success">Delivered</span>';
        } else if ($this->status == OrderStatus::CONFIRMED) {
            return '<span class="p-1 rounded bg-success">Delivery Confirmed</span>';
        }
    }

    public function orderShipping()
    {
        return $this->belongsTo(OrderShipping::class, 'order_id', 'order_id');
    }

    
    /**
     * fcmToken
     * get custom FCM device token
     * @return mixed
     */
    function fcmToken() : mixed {
        return $this->belongsTo(FcmToken::class, 'customer_id', 'customer_id');
    }
}
