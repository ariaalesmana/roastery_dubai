<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'contract_id', 'vendor_id', 'category_id', 'sub_category_id', 'sub_sub_category_id', 'product_type', 'unit', 'merk', 'name', 'sku', 'vendor_sku', 'stock', 'summary', 'description', 'status', 'created_at', 'updated_at'
    ];
}
