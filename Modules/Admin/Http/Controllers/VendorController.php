<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Http\Controllers\LayoutController;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\Vendor\vendor;
use App\Vendor\VendorMaster;
use App\Vendor\VendorContractMaster;
use Illuminate\Support\Facades\Crypt;
use Hash;
use Modules\Admin\Repositories\VendorRepository;

class VendorController extends LayoutController {
    protected $vendorRepository;

    public function __construct(VendorRepository $vendorRepository) {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
        $this->vendorRepository = $vendorRepository;
    }

    public function index(Request $request, $code, $hash) {
        $vendors = Crypt::decryptString($hash);

        if($vendors == 'adminDaftarVendor')
        DB::setDefaultConnection('mysql');
        $vm = $this->vendorRepository->adminGetDaftarVendor($request, $this->user->group->id)->paginate(10);
        $vm->appends($request->only('keyword'));

        return view('admin::vendor.daftar_vendor', [
            'vendor'  => $vm, 
            'style'   => $this->user->group->style,
            'keyword' => $request->keyword
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create(Request $request, $code, $hash) {
        $vendors = Crypt::decryptString($hash);

        if($vendors == 'adminVendorCreate')
        DB::setDefaultConnection('mysql');
        $checkCode = $this->checkCode();

        return view('admin::vendor.tambah_vendor', [
            'style' => $this->user->group->style,
            'inamart_code' => $checkCode
        ]);
    }

    public function create_post(Request $request) {
        $this->validation($request);

        $v  = new vendor;
        $v->setConnection($this->user->group->katalog);
        $v  = $this->vendorRepository->saveVendor($request, $v, $this->user->group->katalog);

        $vm = new VendorMaster;
        $vm->setConnection('mysql');
        $vm = $this->vendorRepository->saveVendorMaster($request, $v, $vm, $this->user->group->id);

        toastr()->success('Data berhasil disimpan');
        return redirect()->route('admin.vendor',[$this->user->group->code, Crypt::encryptString('adminDaftarVendor')]);
    }

    public function edit(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        $vm = VendorMaster::find($id);
        
        return view('admin::vendor.edit_vendor', [
            'style' => $this->user->group->style,
            'vendor_master' => $vm
        ]);
    }

    public function edit_post(Request $request) {
        $this->validation($request);

        $vm = new VendorMaster;
        $vm->setConnection('mysql');
        $vm = $vm->find($request->vendor_master_id);

        $v = new vendor;
        $v->setConnection($this->user->group->katalog);
        $v = $v->find($vm->vendor_katalog_id);
        $v = $this->vendorRepository->saveVendor($request, $v, $this->user->group->katalog);

        $vm = $this->vendorRepository->saveVendorMaster($request, $v, $vm, $this->user->group->id);

        toastr()->success('Data berhasil disimpan');
        return redirect()->back();
    }

    public function edit_ubah_password(Request $request) {
        $password     = Hash::make($request->modal_password);

        $vm           = new VendorMaster;
        $vm->setConnection('mysql');
        $vm           = $vm->find($request->vendor_master_id);
        $vm->password = $password;
        $vm->save();

        toastr()->success('Password berhasil diupdate');
        return redirect()->back();
    }

    public function delete(Request $request) {
        $vm        = VendorMaster::find($request->vendorMasterId);
        $vContract = $vm->vendor_contract_master;
        $vCode     = $vm->vendor_code_master;
        $vAddress  = $vm->vendor_address_master;
        if($vContract->count() > 0) {
            $vContract->delete();
        }
        if(isset($vCode)) {
            $vCode->delete();
        }
        if(isset($vAddress)) {
            $vAddress->delete();
        }
        toastr()->success('Vendor berhasil dihapus');
        return redirect()->back();
    }

    public function validation($request) {
        $this->validate($request,[
            'vendor_name'   => 'required',
            'vendor_number' => 'required',
            'email'         => 'required|email',
            'katasandi'     => 'required',
            'company_code'  => 'required',
            'inamart_code'  => 'required',
            'address'       => 'required',
            'city'          => 'required',
            'region'        => 'required',
            'postcode'      => 'required',
            'telephone'     => 'required'
        ]);
    }
}
