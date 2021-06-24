<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Http\Controllers\LayoutController;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\Customer\Customer;
use App\Customer\CustomerGroup;
use Illuminate\Support\Facades\Crypt;
use Modules\Admin\Repositories\CustomerRepository;

class CustomerController extends LayoutController {
    protected $vendorRepository;

    public function __construct(CustomerRepository $customerRepository) {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
        $this->customerRepository = $customerRepository;
    }

    public function index(Request $request, $code, $hash) {
        $customers = Crypt::decryptString($hash);

        if($customers == 'customer')
        DB::setDefaultConnection('mysql');
        $customer = Customer::where('group_id', $this->user->group->id)
        ->when($request->keyword, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->keyword}%")
                  ->orWhere('middle_name', 'like', "%{$request->keyword}%")
                  ->orWhere('last_name', 'like', "%{$request->keyword}%")
                  ->orWhere('email', 'like', "%{$request->keyword}%");
            });
        })
        ->orderBy('created_at', 'desc')->paginate(10);
        $customer->appends($request->only('keyword'));

        return view('admin::customer.daftar_customer', [
            'customer' => $customer, 
            'style'    => $this->user->group->style,
            'keyword'  => $request->keyword
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function edit(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);

        DB::setDefaultConnection('mysql');
        $customer       = Customer::find($id);
        $customer_group = CustomerGroup::where('group_id', $this->user->group->id)->get();

        return view('admin::customer.edit_customer',[
            'customer'       => $customer,
            'customer_group' => $customer_group,
            'style'          => $this->user->group->style
        ]);
    }

    public function create(Request $request, $code, $hash) {
        $customers = Crypt::decryptString($hash);

        if($customers == 'customer')
        DB::setDefaultConnection('mysql');
        $customer_group = CustomerGroup::where('group_id', $this->user->group->id)->get();

        return view('admin::customer.tambah_customer', [
            'style'          => $this->user->group->style, 
            'customer_group' => $customer_group
        ]);
    }

    public function create_post(Request $request) {

        $this->validation($request);

        $cust = new Customer;
        $cust->setConnection('mysql');
        $cust = $this->customerRepository->saveCustomer($request, $cust, $this->user->group->id);

        toastr()->success('Data berhasil disimpan');
        return redirect()->route('admin.customer',[$this->user->group->code, Crypt::encryptString('customer')]);
    }

    public function edit_post(Request $request) {

        $this->validation($request);

        $cust = new Customer;
        $cust->setConnection('mysql');
        $cust = $cust->find($request->customer_id);
        $cust = $this->customerRepository->saveCustomer($request, $cust, $this->user->group->id);

        toastr()->success('Data berhasil disimpan');
        return redirect()->route('admin.customer',[$this->user->group->code, Crypt::encryptString('customer')]);
    }

    public function validation($request) {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'gender'     => 'required',
            'katasandi'  => 'required',
            'group'      => 'required',
            'street'     => 'required',
            'city'       => 'required',
            'region'     => 'required',
            'postcode'   => 'required',
            'telephone'  => 'required'
        ]);
    }
}
