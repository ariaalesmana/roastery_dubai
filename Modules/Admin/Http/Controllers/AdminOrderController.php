<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Http\Controllers\LayoutController;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\Order\Order;
use Illuminate\Support\Facades\Crypt;

class AdminOrderController extends LayoutController {
    function __construct() {
        $this->middleware('permission:administrator', ['only' => ['index']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request, $code, $hash) {
        $orders = Crypt::decryptString($hash);
        if($orders == 'adminorder')
        DB::setDefaultConnection('mysql');
        $order = Order::where('order_from', $this->user->group->code)
            ->orderBy('order_number', 'asc')
            ->orderBy('cart_number', 'asc')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return view('admin::orders.order.order', [
            'order' => $order, 
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function search(Request $request, $code) {
        DB::setDefaultConnection('mysql');
        $order = Order::where('order_from', $this->user->group->code)
            ->where('order_number', 'like', '%' .$request->q. '%')
            ->orWhere('name', 'like', '%' .$request->q. '%')
            ->orWhere('no_pr', 'like', '%' .$request->q. '%')
            ->orderBy('order_number', 'asc')
            ->orderBy('cart_number', 'asc')
            ->orderBy('updated_at', 'desc');
        return view('admin::orders.order.order',[
            'order' => $order->paginate(10),
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function show(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        DB::setDefaultConnection('mysql');
        $order = Order::find($id);
        return view('admin::orders.order.detail_order',[
            'order' => $order,
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }
}
