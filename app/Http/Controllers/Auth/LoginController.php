<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Config;
use DB;
use App\Vendor\VendorMaster;

class LoginController extends Controller {

    use AuthenticatesUsers;
    protected $redirectTo = '/katalog';

    public function __construct() {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:customer')->except('logout');
    }

    public function showAdminLoginForm() {
        return view('auth.login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request) {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->route('admin.index');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function showCustomerLoginForm() {
        return view('auth.login');
    }

    public function customerLogin(Request $request) {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->route('katalog.index');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function showVendorLoginForm() {
        return view('auth.login', ['url' => 'vendor']);
    }

    public function vendorLogin(Request $request) {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('vendor')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            $user = VendorMaster::where('email', $request->email)->first();
            if(isset($user)) {
                if($user->status == null) {
                    return redirect()->back();
                }
            }
            return redirect()->route('vendor.index');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

}