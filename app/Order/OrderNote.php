<?php

namespace App\Order;

use Illuminate\Database\Eloquent\Model;

class OrderNote extends Model {

    public function order() {
        return $this->hasOne('\App\Order\Order', 'order_number', 'order_number');
    }
}
