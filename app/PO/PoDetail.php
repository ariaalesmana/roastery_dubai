<?php

namespace App\PO;

use Illuminate\Database\Eloquent\Model;

class PoDetail extends Model {

    protected $fillable = [
        'po_id', 'uraian_pekerjaan', 'volume', 'satuan', 'harga_ecatalogue_tanpa_ppn', 'jumlah_tanpa_ppn', 'harga_satuan_final_tanpa_ppn', 'harga_total_final_tanpa_ppn', 'created_at', 'updated_at'
    ];

    public function po() {
        return $this->hasOne('\App\PO\po', 'id', 'po_id');
    }
}
