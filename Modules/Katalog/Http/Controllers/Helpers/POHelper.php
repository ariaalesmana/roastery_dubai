<?php

use App\PO\po;
use App\PO\PoDetail;
use App\PO\PoDetailBiaya;
use App\PO\PoTotalJumlahTanpaPpn;
use App\PO\PoTotalHargaSatuanFinalTanpaPpn;
use App\PO\PoTotalHargaTotalFinalTanpaPpn;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

if (! function_exists('create_po')) {
    function create_po($user, $request) {
        $po = new po;
        $po->order_number = $request->order_number;
        $po->po_by = $user->id;
        $po->vendor_id = $request->vendor_id;
        $po->vendor_from = $request->vendor_from;
        $po->vendor_number = $request->vendor_number;
        $po->vendor_name = $request->vendor_name;
        $po->po_number = $request->po_number;
        $po->po_date = $request->po_date;
        $po->po_from = $user->group->code;
        $po->nama_pekerjaan = $request->nama_pekerjaan;
        $po->no_pr = $request->no_pr;
        $po->save();
        add_po_detail($po, $user, $request);
    }
}

if (! function_exists('add_po_detail')) {
    function add_po_detail($po, $user, $request) {
        if($request->has('uraian_pekerjaan')) {
            foreach($request->uraian_pekerjaan as $index => $up) {
                $po_detail = new PoDetail();
                $po_detail->po_id = $po->id;
                $po_detail->uraian_pekerjaan = $up;
                $po_detail->volume = $request->vol[$index];
                $po_detail->satuan = $request->sat[$index];
                $po_detail->harga_ecatalogue_tanpa_ppn = $request->harga_ecatalogue_tanpa_ppn[$index];
                $po_detail->jumlah_tanpa_ppn = $request->jumlah_tanpa_ppn[$index];
                $po_detail->harga_satuan_final_tanpa_ppn = str_replace(',', '', $request->harga_satuan_final[$index]);
                $po_detail->harga_total_final_tanpa_ppn = str_replace(',', '', $request->jumlah_harga_satuan_final[$index]);
                $po_detail->save();
            }
        }
        add_po_detail_biaya_pengiriman($po, $user, $request);
    }
}

if (! function_exists('add_po_detail_biaya_pengiriman')) {
    function add_po_detail_biaya_pengiriman($po, $user, $request) {
        if($request->has('ongkir_name')) {
            foreach($request->ongkir_name as $index => $on) {
                $po_detail_biaya_pengiriman = new PoDetailBiaya();
                $po_detail_biaya_pengiriman->po_id = $po->id;
                $po_detail_biaya_pengiriman->uraian_pekerjaan = $on;
                $po_detail_biaya_pengiriman->harga_ecatalogue_tanpa_ppn = $request->ongkir_tanpa_ppn[$index];
                $po_detail_biaya_pengiriman->jumlah_tanpa_ppn = $request->jumlah_ongkir_tanpa_ppn[$index];
                $po_detail_biaya_pengiriman->harga_satuan_final_tanpa_ppn = str_replace(',', '', $request->harga_satuan_final_ongkir[$index]);
                $po_detail_biaya_pengiriman->harga_total_final_tanpa_ppn = str_replace(',', '', $request->jumlah_harga_satuan_final_ongkir[$index]);
                $po_detail_biaya_pengiriman->save();
            }
        }
        add_po_total_jumlah_tanpa_ppn($po, $user, $request);
    }
}

if (! function_exists('add_po_total_jumlah_tanpa_ppn')) {
    function add_po_total_jumlah_tanpa_ppn($po, $user, $request) {
        $po_total_jumlah_tanpa_ppn = new PoTotalJumlahTanpaPpn();
        $po_total_jumlah_tanpa_ppn->po_id = $po->id;
        $po_total_jumlah_tanpa_ppn->subtotal = $request->subtotal_jumlah_tanpa_ppn;
        $po_total_jumlah_tanpa_ppn->ppn = str_replace(',', '', $request->ppn_jumlah_tanpa_ppn);
        $po_total_jumlah_tanpa_ppn->total = str_replace(',', '', $request->total_jumlah_tanpa_ppn);
        $po_total_jumlah_tanpa_ppn->harga_pembulatan = str_replace(',', '', $request->pembulatan_jumlah_tanpa_ppn);
        $po_total_jumlah_tanpa_ppn->save();
        add_po_total_harga_satuan_final_tanpa_ppn($po, $user, $request);
    }
}

if (! function_exists('add_po_total_harga_satuan_final_tanpa_ppn')) {
    function add_po_total_harga_satuan_final_tanpa_ppn($po, $user, $request) {
        $po_total_harga_satuan_final_tanpa_ppn = new PoTotalHargaSatuanFinalTanpaPpn();
        $po_total_harga_satuan_final_tanpa_ppn->po_id = $po->id;
        $po_total_harga_satuan_final_tanpa_ppn->subtotal = str_replace(',', '', $request->subtotal_harga_satuan_final);
        $po_total_harga_satuan_final_tanpa_ppn->ppn = str_replace(',', '', $request->ppn_harga_satuan_final);
        $po_total_harga_satuan_final_tanpa_ppn->total = str_replace(',', '', $request->total_harga_satuan_final);
        $po_total_harga_satuan_final_tanpa_ppn->harga_pembulatan = str_replace(',', '', $request->pembulatan_harga_satuan_final);
        $po_total_harga_satuan_final_tanpa_ppn->save();
        add_po_total_harga_total_final_tanpa_ppn($po, $user, $request);
    }
}

if (! function_exists('add_po_total_harga_total_final_tanpa_ppn')) {
    function add_po_total_harga_total_final_tanpa_ppn($po, $user, $request) {
        $po_total_harga_total_final_tanpa_ppn = new PoTotalHargaTotalFinalTanpaPpn();
        $po_total_harga_total_final_tanpa_ppn->po_id = $po->id;
        $po_total_harga_total_final_tanpa_ppn->subtotal = str_replace(',', '', $request->subtotal_harga_total_final);
        $po_total_harga_total_final_tanpa_ppn->ppn = str_replace(',', '', $request->ppn_harga_total_final);
        $po_total_harga_total_final_tanpa_ppn->total = str_replace(',', '', $request->total_harga_total_final);
        $po_total_harga_total_final_tanpa_ppn->harga_pembulatan = str_replace(',', '', $request->pembulatan_harga_total_final);
        $po_total_harga_total_final_tanpa_ppn->save();
        return true;
    }
}