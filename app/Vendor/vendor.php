<?php

namespace App\Vendor;

use Illuminate\Database\Eloquent\Model;
use App\Vendor\VendorAddress;

class vendor extends Model {
    protected $table = "vendor";

    public function product_vendor() {
        return $this->hasMany('\App\Product\ProductVendor', 'vendor_id', 'id');
    }

    public function vendor_address() {
        return $this->hasOne('\App\Vendor\VendorAddress', 'vendor_id', 'id');
    }
}
