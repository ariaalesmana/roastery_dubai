<?php

namespace App\Product;

use Illuminate\Database\Eloquent\Model;

class ProductMediaGallery extends Model {

    protected $fillable = [
        'attribute_id', 'product_id', 'value', 'created_at', 'updated_at'
    ];
    
    public function product() {
        return $this->hasOne('\App\Product\Product', 'id', 'product_id');
    }
}
