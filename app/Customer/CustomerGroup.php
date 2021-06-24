<?php

namespace App\Customer;

use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model {

    protected $fillable = [
        'group_id', 'customer_group_code', 'tax_class_id', 'created_at', 'updated_at'
    ];

    public function customer_grouping() {
        return $this->hasMany('\App\Customer\CustomerGrouping', 'customer_group_id', 'id');
    }

    public function group() {
        return $this->hasOne('\App\Group\group', 'id', 'group_id');
    }
}
