<?php

namespace App\Group;

use Illuminate\Database\Eloquent\Model;

class group extends Model {

    protected $table = "group";
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'created_at', 'updated_at'
    ];

    public function customer_group() {
        return $this->hasMany('\App\Customer\CustomerGroup', 'group_id', 'id');
    }

    public function customer() {
        return $this->hasMany('\App\Customer\Customer', 'group_id', 'id');
    }

    public function admin_user() {
        return $this->hasMany('\App\Admin\AdminUser', 'group_id', 'id');
    }

    public function list_katalog() {
        return $this->hasOne('\App\Katalog\ListKatalog', 'group_id', 'id');
    }

    public function style() {
        return $this->hasOne('\App\Style\style', 'group_id', 'id');
    }

    public function vendor_master() {
        return $this->hasMany('\App\Vendor\VendorMaster', 'group_id', 'id');
    }
}
