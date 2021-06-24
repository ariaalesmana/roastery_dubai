<?php

namespace App\Product;

use Illuminate\Database\Eloquent\Model;

class ProductGroupRule extends Model {

    public function product_group() {
        return $this->hasMany('\App\Product\ProductGroup', 'rule_id', 'id');
    }
}
