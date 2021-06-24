<?php

namespace App\Order;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model {

    protected $fillable = [
        'order_id', 'first_name', 'last_name', 'email', 'company', 'phone', 'fax', 'address', 'city', 'province', 'postcode', 'created_at', 'updated_at'
    ];

    public function order() {
        return $this->hasOne('\App\Order\Order', 'id', 'order_id');
    }
}
