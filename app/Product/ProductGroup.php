<?php

namespace App\Product;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model {

    public function product() {
        return $this->hasOne('\App\Product\Product', 'id', 'product_id');
    }

    public function product_group_rules() {
        return $this->hasOne('\App\Product\ProductGroupRule', 'id', 'rule_id');
    }

    public function product_vendor() {
        return $this->hasOne('\App\Product\ProductVendor', 'product_id', 'product_id');
    }
}
