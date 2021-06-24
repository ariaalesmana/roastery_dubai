<?php

namespace App\Compare;

use Illuminate\Database\Eloquent\Model;

class Comparison extends Model {

    protected $fillable = [
        'product_id', 'product_from', 'name', 'image', 'qty', 'price', 'unit', 'sku', 'vendor_sku', 'vendor_id', 'vendor_name', 'vendor_email', 'buyer_id', 'buyer_name', 'buyer_email', 'status', 'created_at', 'updated_at', 'deleted_at'
    ];
}
