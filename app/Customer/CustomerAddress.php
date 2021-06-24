<?php

namespace App\Customer;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model {

    protected $fillable = [
        'customer_id', 'street', 'province', 'city', 'region', 'postcode', 'telephone', 'fax', 'created_at', 'updated_at'
    ];

    public function customer() {
        return $this->hasOne('\App\Customer\Customer', 'id', 'customer_id');
    }
}
