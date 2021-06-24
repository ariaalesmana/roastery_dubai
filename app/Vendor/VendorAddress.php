<?php

namespace App\Vendor;

use Illuminate\Database\Eloquent\Model;

class VendorAddress extends Model {

    public function vendor() {
        return $this->hasOne('\App\Vendor\vendor', 'id', 'vendor_id');
    }
}
