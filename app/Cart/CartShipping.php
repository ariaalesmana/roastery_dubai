<?php

namespace App\Cart;

use Illuminate\Database\Eloquent\Model;

class CartShipping extends Model {

    protected $fillable = [
        'cart_id', 'cart_number', 'product_id', 'name', 'price', 'status', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function cart() {
        return $this->hasOne('\App\Cart\Cart', 'id', 'cart_id');
    }
}
