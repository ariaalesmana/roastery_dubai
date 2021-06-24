<?php

namespace App\PO;

use Illuminate\Database\Eloquent\Model;

class PoTotalHargaSatuanFinalTanpaPpn extends Model {

    protected $fillable = [
        'po_id', 'subtotal', 'ppn', 'total', 'harga_pembulatan', 'created_at', 'updated_at'
    ];

    public function po() {
        return $this->hasOne('\App\PO\po', 'id', 'po_id');
    }
}
