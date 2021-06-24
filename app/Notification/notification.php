<?php

namespace App\Notification;

use Illuminate\Database\Eloquent\Model;

class notification extends Model {

    protected $table = "notification";
    protected $primaryKey = 'id';

    public function order() {
        return $this->hasOne('\App\Order\Order', 'id', 'order_id');
    }

    public function order_address() {
        return $this->hasOne('\App\Order\OrderAddress', 'order_id', 'order_id');
    }

    public function order_detail() {
        return $this->hasMany('\App\Order\OrderDetail', 'order_id', 'order_id');
    }

    public function order_shipping() {
        return $this->hasMany('\App\Order\OrderShipping', 'order_id', 'order_id');
    }

    public function user() {
        return $this->hasOne('\App\Customer\Customer', 'id', 'user_id');
    }
}
