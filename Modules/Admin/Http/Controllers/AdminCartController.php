<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Http\Controllers\LayoutController;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\Cart\Cart;
use Illuminate\Support\Facades\Crypt;

class AdminCartController extends LayoutController {
    function __construct() {
        $this->middleware('permission:administrator', ['only' => ['index']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request, $code, $hash) {
        $carts = Crypt::decryptString($hash);
        if($carts == 'admincart')
        DB::setDefaultConnection('mysql');
        $cart = Cart::where('buyer_from', $this->user->group->code)
            ->where('status', 0)
            ->orderBy('cart_number', 'asc')
            ->orderBy('buyer_name', 'asc')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return view('admin::orders.cart.keranjang', [
            'cart' => $cart, 
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function search(Request $request, $code) {
        DB::setDefaultConnection('mysql');
        $cart = Cart::where('buyer_from', $this->user->group->code)
            ->where('name', 'like', '%' .$request->q. '%')
            ->orWhere('buyer_name', 'like', '%' .$request->q. '%')
            ->orWhere('buyer_email', 'like', '%' .$request->q. '%')
            ->orderBy('cart_number', 'asc')
            ->orderBy('buyer_name', 'asc')
            ->orderBy('updated_at', 'desc');
        return view('admin::orders.cart.keranjang',[
            'cart' => $cart->paginate(10),
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function show(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        DB::setDefaultConnection('mysql');
        $cart = Cart::find($id);
        return view('admin::orders.cart.detail_keranjang',[
            'cart' => $cart,
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }
}
