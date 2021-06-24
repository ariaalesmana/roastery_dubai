<?php

namespace App\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Vendor\VendorAddressMaster;
use App\Vendor\VendorCodeMaster;
use Hash;
use Laravel\Passport\HasApiTokens;

class VendorMaster extends Authenticatable {
    use Notifiable, HasApiTokens;
    use HasRoles;


    //protected $connection= 'mysql';

    protected $guard = 'vendor';

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group() {
        return $this->hasOne('\App\Group\group', 'id', 'group_id');
    }

    public function vendor_address_master() {
        return $this->hasOne('\App\Vendor\VendorAddressMaster', 'vendor_master_id', 'id');
    }

    public function vendor_code_master() {
        return $this->hasOne('\App\Vendor\VendorCodeMaster', 'vendor_master_id', 'id');
    }

    public function vendor_contract_master() {
        return $this->hasMany('\App\Vendor\VendorContractMaster', 'vendor_master_id', 'id');
    }

    public function admin_search_daftar_vendor($request, $group_id) {
        $vendor_master = $this->where('group_id', $group_id)
            ->where('vendor_number', 'like', '%' .$request->q. '%')
            ->orWhere('vendor_name', 'like', '%' .$request->q. '%')
            ->orderBy('updated_at', 'desc');
        return $vendor_master;
    }
}
