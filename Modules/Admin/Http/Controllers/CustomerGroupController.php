<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Http\Controllers\LayoutController;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\Category\Category;
use App\Product\Product;
use App\Product\ProductGroupRule;
use App\Vendor\vendor;
use App\Vendor\VendorAddress;
use App\Vendor\VendorMaster;
use App\Vendor\VendorAddressMaster;
use App\Vendor\VendorCodeMaster;
use App\Product\ProductVendor;
use App\Category\CategoryProduct;
use App\Lokasi\Location;
use App\Style\style;
use App\Group\group;
use App\Customer\Customer;
use App\Customer\CustomerGroup;
use Illuminate\Support\Facades\Crypt;

class CustomerGroupController extends LayoutController {
    function __construct() {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request, $code, $hash) {
        $customer_groups = Crypt::decryptString($hash);

        if($customer_groups == 'customer_group')
        DB::setDefaultConnection('mysql');
        $customer_group = CustomerGroup::where('group_id', $this->user->group->id)
        ->when($request->keyword, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('customer_group_code', 'like', "%{$request->keyword}%");
            });
        })
        ->orderBy('created_at', 'desc')->paginate(10);
        $customer_group->appends($request->only('keyword'));

        return view('admin::customer.customer_group.customer_group', [
            'customer_group' => $customer_group, 
            'style'          => $this->user->group->style,
            'keyword'        => $request->keyword
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function show(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        DB::setDefaultConnection('mysql');
        $customer_group      = CustomerGroup::find($id);
        $relation_customer   = $customer_group->customer_grouping()->paginate(10, ['*'], 'cust');
        $product_group_rules = new ProductGroupRule;
        $product_group_rules = $product_group_rules->setConnection($this->user->group->katalog)->where('cust_groups', $customer_group->id)->first();
        if($product_group_rules != null) {
            $relation_product = $product_group_rules->product_group()->whereHas('product')->paginate(10, ['*'], 'prod');
        } else {
            $relation_product = [];
        }
        return view('admin::customer.customer_group.detail_customer_group',[
            'customer_group'    => $customer_group,
            'relation_customer' => $relation_customer,
            'relation_product'  => $relation_product,
            'style'             => $this->user->group->style
        ])
        ->with('a', ($request->input('cust', 1) - 1) * 10)
        ->with('i', ($request->input('prod', 1) - 1) * 10);
    }

    public function create(Request $request, $code, $hash) {
        return view('admin::customer.customer_group.create_customer_group',[
            'style' => $this->user->group->style
        ]);
    }

    public function create_post(Request $request) {
        $this->validation($request);

        $custGroup = new CustomerGroup;
        $custGroup->setConnection('mysql');
        $custGroup->group_id            = $this->user->group->id;
        $custGroup->customer_group_code = $request->customer_group_code;
        $custGroup->tax_class_id        = 3;
        $custGroup->save();

        toastr()->success('Data berhasil disimpan');
        return redirect()->route('admin.customer_group',[$this->user->group->code, Crypt::encryptString('customer_group')]);
    }

    public function edit_post(Request $request) {
        $this->validation($request);

        $custGroup = new CustomerGroup;
        $custGroup->setConnection('mysql');
        $custGroup                      = $custGroup->find($request->customer_group_id);
        $custGroup->customer_group_code = $request->customer_group_code;
        $custGroup->save();

        toastr()->success('Data berhasil disimpan');
        return redirect()->route('admin.customer_group',[$this->user->group->code, Crypt::encryptString('customer_group')]);
    }

    public function validation($request) {
        $this->validate($request,[
            'customer_group_code' => 'required'
        ]);
    }
}
