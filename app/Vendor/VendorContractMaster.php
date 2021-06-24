<?php

namespace App\Vendor;

use Illuminate\Database\Eloquent\Model;

class VendorContractMaster extends Model {

    protected $fillable = [
        'vendor_master_id', 'contract_name', 'contract_no', 'contract_start', 'contract_end', 'contract_price', 'category', 'status', 'created_by', 'created_at', 'updated_at'
    ];

    public function vendor_master() {
        return $this->hasOne('\App\Vendor\VendorMaster', 'id', 'vendor_master_id');
    }

    public function product_contract() {
        return $this->hasMany('\App\Product\ProductContract', 'vendor_contract_master_id', 'id');
    }
}
