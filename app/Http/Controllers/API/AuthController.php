<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vendor\VendorMaster;
use Auth;

class AuthController extends Controller {

    public $successStatus = 401;

    public function login(Request $request) {
        $success['success']     = false;
        $success['token']       = null;
        $success['user_detail'] = null;

        if (Auth::guard('vendor')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            $this->successStatus = 200;
            $user                   = VendorMaster::where('email', request('email'))->first();
            $success['success']     = true;
            $success['token']       = $user->createToken('MyApp')->accessToken;
            $success['user_detail'] = $user;
        } else {
            $success['success']     = false;
            $success['token']       = null;
            $success['user_detail'] = null;
            $success['message']     = 'User tidak ditemukan';
        }
        return response()->json($success, $this->successStatus);
    }
}
