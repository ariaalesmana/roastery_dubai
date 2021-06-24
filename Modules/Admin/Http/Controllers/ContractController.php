<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Http\Controllers\LayoutController;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\Category\Category;
use App\Vendor\vendor;
use App\Vendor\VendorMaster;
use App\Vendor\VendorContractMaster;
use Illuminate\Support\Facades\Crypt;
use Modules\Admin\Repositories\ContractRepository;

class ContractController extends LayoutController {

    protected $contractRepository;

    public function __construct(ContractRepository $contractRepository) {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
        $this->contractRepository = $contractRepository;
    }

    public function index(Request $request, $code, $hash) {
        $contracts = Crypt::decryptString($hash);

        if($contracts == 'contract')
        DB::setDefaultConnection('mysql');
        $vcm = $this->contractRepository->adminGetDaftarVendorContract($request, $this->user->group->id)->paginate(10);
        $vcm->appends($request->only('keyword'));

        return view('admin::vendor.vendor_contract.daftar_kontrak',[
            'vendor_contract_master' => $vcm, 
            'style'                  => $this->user->group->style,
            'keyword'                => $request->keyword
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create(Request $request, $code, $hash) {
        $contracts = Crypt::decryptString($hash);

        if($contracts == 'contract_create')
        DB::setDefaultConnection('mysql');
        $vm = new VendorMaster;
        $vm = $vm->where('group_id', $this->user->group->id)->orderBy('created_at', 'desc')->get();

        $category = new Category();
        $category = $category->setConnection($this->user->group->katalog);
        $category = $category->where('level', 2)->where("status", 1)->get();

        return view('admin::vendor.vendor_contract.tambah_kontrak', [
            'vendor_master' => $vm,
            'category'      => $category,
            'style'         => $this->user->group->style
        ]);
    }

    public function edit(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);

        DB::setDefaultConnection('mysql');
        $vcm = VendorContractMaster::find($id);

        $vm  = new VendorMaster;
        $vm  = $vm->where('group_id', $this->user->group->id)->orderBy('created_at', 'desc')->get();

        $category = new Category();
        $category = $category->setConnection($this->user->group->katalog);
        $category = $category->where('level', 2)->where("status", 1)->get();

        return view('admin::vendor.vendor_contract.edit_kontrak', [
            'vendor_contract_master' => $vcm,
            'vendor_master'          => $vm,
            'category'               => $category,
            'style'                  => $this->user->group->style
        ]);
    }

    public function create_post(Request $request) {
        $this->validation($request);

        $vcm = new VendorContractMaster;
        $vcm->setConnection('mysql');
        $vcm = $this->contractRepository->saveVendorContractMaster($request, $vcm);

        toastr()->success('Data berhasil disimpan');
        return redirect()->route('admin.vendor.contract',[$this->user->group->code, Crypt::encryptString('contract')]);
    }

    public function edit_post(Request $request) {
        $this->validation($request);

        $vcm = new VendorContractMaster;
        $vcm->setConnection('mysql');
        $vcm = $vcm->find($request->vendor_master_id);
        $vcm = $this->contractRepository->saveVendorContractMaster($request, $vcm);

        toastr()->success('Data berhasil disimpan');
        return redirect()->route('admin.vendor.contract',[$this->user->group->code, Crypt::encryptString('contract')]);
    }

    public function validation($request) {
        $this->validate($request,[
            'vendor_name'    => 'required',
            'category'       => 'required',
            'contract_name'  => 'required',
            'contract_no'    => 'required',
            'contract_price' => 'required',
            'contract_start' => 'required',
            'contract_end'   => 'required'
        ]);
    }
}
