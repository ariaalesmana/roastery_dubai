<?php

namespace Modules\Admin\Repositories;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Storage;
use Hash;
use App\Http\libraries\Session;
use App\Vendor\VendorMaster;
use App\Vendor\vendor;
use App\Vendor\VendorAddress;
use App\Vendor\VendorAddressMaster;
use App\Vendor\VendorCodeMaster;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class VendorRepository {

    public function adminGetDaftarVendor($request, $group_id) {
        $vm = VendorMaster::where('group_id', $group_id)
        ->when($request->keyword, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('vendor_number', 'like', "%{$request->keyword}%")
                  ->orWhere('vendor_name', 'like', "%{$request->keyword}%");
            });
        })
        ->orderBy('created_at', 'desc');
        return $vm;
    }

    public function saveVendor($request, $v, $database) {
        $v->vendor_number = $request->vendor_number;
        $v->vendor_name   = $request->vendor_name;
        $v->email         = $request->email;
        $v->status        = isset($request->status_vendor) ? $request->status_vendor : null;
        $v->save();

        $va = new VendorAddress;
        $va->setConnection($database);
        if($va->where('vendor_id', $v->id)->first() != null) {
            $va->update([
                'street'    => $request->address,   'city'   => $request->city, 
                'postcode'  => $request->postcode,  'region' => $request->region, 
                'telephone' => $request->telephone, 'fax'    => isset($request->fax) ? $request->fax : null
            ]);
        } else {
            $va->insert([
                'vendor_id' => $v->id,             'street' => $request->address, 'city'      => $request->city,
                'postcode'  => $request->postcode, 'region' => $request->region,  'telephone' => $request->telephone, 
                'fax'       => isset($request->fax) ? $request->fax : null
            ]);
        }
        return $v;
    }

    public function saveVendorMaster($request, $vendor, $vm, $group_id) {
        $vm->group_id          = $group_id;
        $vm->vendor_katalog_id = $vendor->id;
        $vm->vendor_number     = $request->vendor_number;
        $vm->vendor_name       = $request->vendor_name;
        $vm->email             = $request->email;
        $vm->password          = Hash::make($request->katasandi);
        $vm->status            = isset($vendor->status) ? $vendor->status : null;
        $vm->save();

        $vm->assignRole(['3']);

        $vam = new VendorAddressMaster;
        $vam->setConnection('mysql');
        if($vam->where('vendor_master_id', $vm->id)->first() != null) {
            $vam->update([
                'street'    => $request->address,   'city'   => $request->city, 
                'postcode'  => $request->postcode,  'region' => $request->region, 
                'telephone' => $request->telephone, 'fax'    => isset($request->fax) ? $request->fax : null
            ]);
        } else {
            $vam->insert([
                'vendor_master_id' => $vm->id,             'street' => $request->address, 'city'      => $request->city,
                'postcode'         => $request->postcode,  'region' => $request->region,  'telephone' => $request->telephone, 
                'fax'              => isset($request->fax) ? $request->fax : null
            ]);
        }

        $vcm = new VendorCodeMaster;
        $vcm->setConnection('mysql');
        if($vcm->where('vendor_master_id', $vm->id)->first() != null) {
            $vcm->update([
                'company_code' => $request->company_code, 'inamart_code' => $request->inamart_code
            ]);
        } else {
            $vcm->insert([
                'vendor_master_id' => $vm->id, 'company_code' => $request->company_code, 'inamart_code' => $request->inamart_code
            ]);
        }

        return $vm;
    }
}