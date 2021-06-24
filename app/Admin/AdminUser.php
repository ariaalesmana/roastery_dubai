<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class AdminUser extends Authenticatable {
    use Notifiable;
    use HasRoles;
    
    protected $guard = 'admin';

    protected $fillable = [
        'firstname', 'lastname', 'email', 'username', 'password', 'group_id', 'status', 'remember_token', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group() {
        return $this->hasOne('\App\Group\group', 'id', 'group_id');
    }
}
