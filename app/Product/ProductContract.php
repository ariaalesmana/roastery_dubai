<?php

namespace App\Product;

use Illuminate\Database\Eloquent\Model;

class ProductContract extends Model {

    protected $fillable = [
        'vendor_id', 'vendor_master_id', 'vendor_contract_master_id', 'product_id', 'contract_name', 'contract_no', 'contract_start', 'contract_end', 'contract_price', 'category', 'status', 'created_by', 'created_at', 'updated_at'
    ];

    public function product() {
        return $this->hasOne('\App\Product\Product', 'id', 'product_id');
    }

    public function product_vendor() {
        return $this->hasOne('\App\Product\ProductVendor', 'product_id', 'product_id');
    }

    public function vendor_contract_master() {
        return $this->hasOne('\App\Vendor\VendorContractMaster', 'id', 'vendor_contract_master_id');
    }

    public function category_prod() {
        return $this->hasOne('\App\Category\Category', 'id', 'category');
    }
}
