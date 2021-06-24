<?php

namespace App\Product;

use Illuminate\Database\Eloquent\Model;

class ProductShipping extends Model {

    protected $fillable = [
        'product_id', 'name', 'price', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function product() {
        return $this->hasOne('\App\Product\Product', 'id', 'product_id');
    }
}
