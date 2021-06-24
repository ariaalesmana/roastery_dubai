<?php

namespace App\Customer;

use Illuminate\Database\Eloquent\Model;

class CustomerGrouping extends Model {

    protected $fillable = [
        'customer_id', 'customer_group_id', 'created_at', 'updated_at'
    ];

    public function customer_group() {
        return $this->hasOne('\App\Customer\CustomerGroup', 'id', 'customer_group_id');
    }

    public function customer() {
        return $this->hasOne('\App\Customer\Customer', 'id', 'customer_id');
    }
}
