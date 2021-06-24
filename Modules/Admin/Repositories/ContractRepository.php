<?php

namespace Modules\Admin\Repositories;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Storage;
use App\Http\libraries\Session;
use App\Vendor\VendorContractMaster;

class ContractRepository {

    public function adminGetDaftarVendorContract($request, $group_id) {
        $vcm = VendorContractMaster::with(['vendor_master' => function($vm) use($group_id) {
            $vm->where('group_id', $group_id)
               ->orderBy('created_at', 'desc');
        }])
        ->has('vendor_master')
        ->whereHas('vendor_master', function ($vm) use($group_id) {
            $vm->where('group_id', $group_id);    
        })
        ->when($request->keyword, function ($query) use ($request, $group_id) {
            $query->where(function ($q) use ($request, $group_id) {
                $q->where('contract_name', 'like', "%{$request->keyword}%")
                  ->orWhere('contract_no', 'like', "%{$request->keyword}%")
                  ->orWhereHas('vendor_master', function ($vm) use($request, $group_id) {
                      $vm->where('group_id', $group_id)
                         ->where('vendor_name', 'like', "%{$request->keyword}%")
                         ->orderBy('updated_at', 'desc');
                  });
            });
        })
        ->orderBy('created_at', 'desc');
        return $vcm;
    }

    public function saveVendorContractMaster($request, $vcm) {
        $newcontract_start     = date("Y-m-d H:i:s", strtotime($request->contract_start));
        $newcontract_end       = date("Y-m-d H:i:s", strtotime($request->contract_end));
        $vcm->vendor_master_id = $request->vendor_name;
        $vcm->contract_name    = $request->contract_name;
        $vcm->contract_no      = $request->contract_no;
        $vcm->contract_start   = $newcontract_start;
        $vcm->contract_end     = $newcontract_end;
        $vcm->contract_price   = str_replace(',', '', $request->contract_price);
        $vcm->category         = $request->category;
        $vcm->save();
        return $vcm;
    }
}