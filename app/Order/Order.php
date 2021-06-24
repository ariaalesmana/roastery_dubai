<?php

namespace App\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    public function cart() {
        return $this->hasMany('\App\Cart\Cart', 'cart_number', 'cart_number');
    }

    public function order_address() {
        return $this->hasOne('\App\Order\OrderAddress', 'order_id', 'id');
    }

    public function order_detail() {
        return $this->hasMany('\App\Order\OrderDetail', 'order_id', 'id');
    }

    public function order_shipping() {
        return $this->hasMany('\App\Order\OrderShipping', 'order_id', 'id');
    }

    public function notification() {
        return $this->hasMany('\App\Notification\notification', 'order_id', 'id');
    }

    public function vendor_froms() {
        return $this->hasOne('\App\Group\group', 'code', 'vendor_from');
    }

    public function customer() {
        return $this->hasOne('\App\Customer\Customer', 'id', 'order_by');
    }

    public function group() {
        return $this->hasOne('\App\Group\group', 'code', 'order_from');
    }

    public function order_status() {
        return $this->hasOne('\App\Order\OrderStatus', 'status', 'status');
    }

    public function vendors() {
        return $this->hasOne('\App\Order\OrderStatus', 'status', 'status');
    }

    public function order_notes() {
        return $this->hasMany('\App\Order\OrderNotes', 'order_number', 'order_number');
    }
}
