<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class VendorController extends Controller {

    function __construct() {
         $this->middleware('permission:vendor', ['only' => ['redirect']]);
         $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function redirect() {
        return redirect()->route('vendor',[$this->user->group()->first()->code]);
    }
}
