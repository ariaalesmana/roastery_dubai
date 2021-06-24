<?php

namespace App\Cart;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

    protected $fillable = [
        'cart_number', 'product_id', 'product_from', 'name', 'image', 'qty', 'price', 'unit', 'sku', 'vendor_sku', 'vendor_id', 'vendor_name', 'vendor_email', 'buyer_id', 'buyer_name', 'buyer_email', 'buyer_from', 'status', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function cart_shipping() {
        return $this->hasMany('\App\Cart\CartShipping', 'cart_id', 'id');
    }

    public function order() {
        return $this->hasOne('\App\Order\Order', 'cart_number', 'cart_number');
    }

    public function product_froms() {
        return $this->hasOne('\App\Group\group', 'code', 'product_from');
    }

    public function product_buyer_from() {
        return $this->hasOne('\App\Group\group', 'code', 'buyer_from');
    }
}
