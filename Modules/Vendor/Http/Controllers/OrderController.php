<?php

namespace Modules\Vendor\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Vendor\Http\Controllers\LayoutController;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\Category\Category;
use App\Product\Product;
use App\Vendor\vendor;
use App\Vendor\VendorAddress;
use App\Vendor\VendorMaster;
use App\Vendor\VendorAddressMaster;
use App\Vendor\VendorCodeMaster;
use App\Vendor\VendorContractMaster;
use App\Product\ProductVendor;
use App\Product\ProductContract;
use App\Product\ProductShipping;
use App\Category\CategoryProduct;
use App\Lokasi\Location;
use App\Product\ProductGroup;
use App\Product\ProductGroupRule;
use App\Group\group;
use App\Style\style;
use App\Order\Order;
use App\Order\OrderNote;
use Illuminate\Support\Facades\Crypt;

class OrderController extends LayoutController {
    function __construct() {
        $this->middleware('permission:vendor', ['only' => ['index']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request, $code, $hash) {
        $orders = Crypt::decryptString($hash);
        if($orders == 'vendororder')
        DB::setDefaultConnection('mysql');
        $order = Order::where('vendor_id', $this->user->vendor_katalog_id)->where('vendor_from', $this->user->group->code);
        if(isset($request->showAll)) {
            $pagePaginate = $order->count();
            return view('vendor::order.index',['order' => $order->paginate($pagePaginate), 'style' => $this->user->group->style])
                ->with('i', ($request->input('page', 1) - 1) * $pagePaginate);
        } else {
            return view('vendor::order.index',['order' => $order->paginate(10), 'style' => $this->user->group->style])
                ->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function detail(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        DB::setDefaultConnection('mysql');
        $order = Order::find($id);
        return view('vendor::order.detail',[
            'order' => $order, 
            'style' => $this->user->group->style
        ]);
    }

    public function kirim(Request $request, $code) {
        DB::setDefaultConnection('mysql');
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->save();

        $order_notes = new OrderNote;
        $order_notes->type = 'Vendor';
        $order_notes->order_number = $order->order_number;
        $order_notes->note = $request->catatan;
        $order_notes->save();

        send_email_order_konfirmasi($order);
        send_email_order_konfirmasi_admin($order);

        return redirect()->route('vendor.order.detail', [Auth()->user()->group->code, Crypt::encryptString($order->id)]);
    }

    public function notes(Request $request, $code) {
        $order = new Order;
        $order->setConnection('mysql');
        $order = $order->where('order_number', $request->order_number)->first();
        $order_notes = $order->order_notes;
        $customer = $order->customer;
        return response()->json([
            'order' => $order,
            'order_notes' => $order_notes,
            'customer' => $customer
        ], 200);
    }

    public function notes_post(Request $request, $code) {
        DB::setDefaultConnection('mysql');
        $order_notes = new OrderNote;
        $order_notes->order_number = $request->order_number;
        $order_notes->type = $request->type;
        $order_notes->note = $request->catatan;
        $order_notes->save();

        return response()->json($request->order_number, 200);
    }
}
