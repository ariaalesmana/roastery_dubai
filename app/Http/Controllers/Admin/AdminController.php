<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller {

    function __construct() {
         $this->middleware('permission:administrator', ['only' => ['redirect']]);
         $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function redirect() {
        return redirect()->route('admin',[$this->user->group()->first()->code]);
    }

}
