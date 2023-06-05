<?php

namespace App\Models;

use App\Traits\HasUserCreatedTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes, HasUserCreatedTrait;
    
    protected $fillable = [
        'code',
        'supplier_id',
        'order_date',
        'delivery_date',
        'delivery_address',
        'payment_methods',
        'user_create'
    ];
    protected $appends = [
        'payment_method_text', 
        'formatted_order_date',
        'formatted_delivery_date',
    ];

    protected static function boot() {
        parent::boot();

        // xoa cac ban ghi trong order_assets khi order forceDelete()
        static::forceDeleted(function ($order) {
            $order->typeAssetsInOrder()->detach();
        });
    }

    //Relations
    public function typeAssetsInOrder() {
        return $this->belongsToMany(TypeAssets::class, 'order_assets', 'order_id', 'type_asset_id')->withPivot('price', 'quantity');
    }
    public function supplier() {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
 
    // Accessors
    public function getOrderDateAttribute()
    {
        return Carbon::parse($this->attributes['order_date'])->format('Y-m-d');
    }

    public function getDeliveryDateAttribute()
    {
        return Carbon::parse($this->attributes['delivery_date'])->format('Y-m-d');
    }

    public function getFormattedOrderDateAttribute()
    {
        return Carbon::parse($this->attributes['order_date'])->format('d/m/Y');
    }

    public function getFormattedDeliveryDateAttribute()
    {
        return Carbon::parse($this->attributes['delivery_date'])->format('d/m/Y');
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('H:i:s, d/m/Y');
    }
    public function getPaymentMethodTextAttribute() {
        return config('params.paymentmethods')[$this->attributes['payment_methods']];
    }
}
