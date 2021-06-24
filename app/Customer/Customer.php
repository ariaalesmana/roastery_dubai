<?php

namespace App\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class Customer extends Authenticatable {

    use Notifiable, HasApiTokens;
    use HasRoles;
    protected $guard = 'customer';

    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'email', 'password', 'group_id', 'gender', 'company', 'status', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group() {
        return $this->hasOne('\App\Group\group', 'id', 'group_id');
    }

    public function customer_address() {
        return $this->hasOne('\App\Customer\CustomerAddress', 'customer_id', 'id');
    }

    public function customer_grouping() {
        return $this->hasMany('\App\Customer\CustomerGrouping', 'customer_id', 'id');
    }
}
