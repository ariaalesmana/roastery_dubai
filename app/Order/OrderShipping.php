<?php

namespace App\Order;

use Illuminate\Database\Eloquent\Model;

class OrderShipping extends Model {

    protected $fillable = [
        'order_detail', 'order_id', 'product_id', 'name', 'price', 'status', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function order() {
        return $this->hasOne('\App\Order\Order', 'id', 'order_id');
    }

    public function order_detail() {
        return $this->hasOne('\App\Order\OrderDetail', 'id', 'order_detail_id');
    }

    public function notification() {
        return $this->hasMany('\App\Notification\notification', 'order_id', 'id');
    }
}
