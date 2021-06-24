<?php

namespace App\Katalog;

use Illuminate\Database\Eloquent\Model;

class ListKatalog extends Model {

    protected $fillable = [
        'name', 'group_id', 'code', 'module', 'created_at', 'updated_at'
    ];

    public function group() {
        return $this->hasOne('\App\Group\group', 'id', 'group_id');
    }
}
