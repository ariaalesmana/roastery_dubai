<?php

namespace App\PO;

use Illuminate\Database\Eloquent\Model;

class po extends Model {

    protected $table = "po";

    public function order() {
        return $this->hasOne('\App\Order\Order', 'order_number', 'order_number');
    }

    public function po_detail() {
        return $this->hasMany('\App\PO\PoDetail', 'po_id', 'id');
    }

    public function po_detail_biaya_pengiriman() {
        return $this->hasMany('\App\PO\PoDetailBiaya', 'po_id', 'id');
    }

    public function po_total_jumlah_tanpa_ppn() {
        return $this->hasOne('\App\PO\PoTotalJumlahTanpaPpn', 'po_id', 'id');
    }

    public function po_total_harga_satuan_final_tanpa_ppn() {
        return $this->hasOne('\App\PO\PoTotalHargaSatuanFinalTanpaPpn', 'po_id', 'id');
    }

    public function po_total_harga_total_final_tanpa_ppn() {
        return $this->hasOne('\App\PO\PoTotalHargaTotalFinalTanpaPpn', 'po_id', 'id');
    }
}
