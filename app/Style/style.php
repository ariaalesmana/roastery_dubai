<?php

namespace App\Style;

use Illuminate\Database\Eloquent\Model;

class style extends Model {

    protected $table = "style";
    protected $primaryKey = 'id';

    protected $fillable = [
        'group_id', 'logo', 'small_logo', 'color', 'url_image', 'created_at', 'updated_at'
    ];

    public function group() {
        return $this->hasOne('\App\Group\group', 'id', 'group_id');
    }
}
