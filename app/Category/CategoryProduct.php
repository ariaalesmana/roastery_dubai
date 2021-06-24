<?php

namespace App\Category;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model {

    protected $fillable = [
        'category_id', 'product_id', 'position', 'created_at', 'updated_at'
    ];

    public function product() {
        return $this->hasOne('\App\Product\Product', 'id', 'product_id');
    }

    public function category() {
        return $this->hasOne('\App\Category\Category', 'id', 'category_id');
    }

    public function product_vendor() {
        return $this->hasMany('\App\Product\ProductVendor', 'product_id', 'product_id');
    }
}
