<?php

namespace App\Category;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $primaryKey = 'id';

    protected $fillable = [
        'parent_id', 'name', 'level', 'status', 'created_at', 'updated_at'
    ];

    public function category_product() {
        return $this->hasMany('\App\Category\CategoryProduct', 'category_id', 'id');
    }

    public function product_contract() {
        return $this->hasMany('\App\Product\ProductContract', 'category', 'id');
    }

    public function category() {
        return $this->hasOne('\App\Category\Category', 'id', 'parent_id');
    }
}
