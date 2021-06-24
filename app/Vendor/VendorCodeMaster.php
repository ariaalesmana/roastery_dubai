<?php

namespace App\Vendor;

use Illuminate\Database\Eloquent\Model;

class VendorCodeMaster extends Model {

    public function vendor_master() {
        return $this->hasOne('\App\Vendor\VendorMaster', 'id', 'vendor_master_id');
    }
}
