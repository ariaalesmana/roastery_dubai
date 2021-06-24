<?php

namespace App\Order;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model {

    protected $fillable = [
        'order_id', 'product_id', 'product_from', 'name', 'image', 'qty', 'price', 'unit', 'sku', 'vendor_sku', 'vendor_id', 'vendor_name', 'vendor_email', 'buyer_id', 'buyer_name', 'buyer_email', 'buyer_from', 'status', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function order() {
        return $this->hasOne('\App\Order\Order', 'id', 'order_id');
    }

    public function order_shipping() {
        return $this->hasMany('\App\Order\OrderShipping', 'order_detail_id', 'id');
    }

    public function notification() {
        return $this->hasMany('\App\Notification\notification', 'order_id', 'id');
    }
}
