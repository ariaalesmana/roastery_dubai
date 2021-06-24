<?php

namespace Modules\Katalog\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Katalog\Http\Controllers\LayoutController;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\Category\Category;
use App\Product\Product;
use App\Vendor\vendor;
use App\Product\ProductVendor;
use App\Category\CategoryProduct;
use App\Lokasi\Location;
use App\Cart\Cart;
use App\Style\style;
use App\Product\ProductShipping;
use App\Cart\CartShipping;
use App\Order\Order;
use App\Order\OrderDetail;
use App\Order\OrderNotes;
use App\Order\OrderShipping;
use App\Order\OrderAddress;
use App\Notification\notification;
use Illuminate\Support\Facades\Crypt;
use Modules\Katalog\Repositories\MonitoringRepository;
class MonitoringController extends LayoutController {
    
    function __construct(MonitoringRepository $monitoringRepository) {
        $this->middleware('auth');
        $this->middleware('permission:customer', ['only' => ['pemesanan', 'pemesanan_detail']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
        $this->monitoringRepository = $monitoringRepository;
    }

    public function order(Request $request, $code, $hash) {
        $orders = Crypt::decryptString($hash);
        $order = $this->monitoringRepository->get_order_by_user($orders, $this->user);
        return view('katalog::monitoring.order.index',[
			'order' => $order, 
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => $this->user->group()->first()->code
		]);
    }

    public function order_detail(Request $request, $code, $hash) {
        $order_number = Crypt::decryptString($hash);
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $order = new Order;
        $order->setConnection('mysql');
        $order = $this->monitoringRepository->get_order_by_order_number($order, $this->user, $order_number);
        $data = $this->monitoringRepository->get_order_detail($order);
        return view('katalog::monitoring.order.detail',[
            'order' => $order,
			'data' => $data, 
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => $this->user->group->code
		])->with('search', $request->input('search'));
    }

    public function notes(Request $request, $code) {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $order = new Order;
        $order->setConnection('mysql');
        $order = $this->monitoringRepository->get_order_by_order_number($order, $this->user, $request->order_number);
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

    public function reorder(Request $request, $code, $hash) {
        $order_number = Crypt::decryptString($hash);
        $order = new Order;
        $order->setConnection('mysql');
        $order = $this->monitoringRepository->get_order_by_order_number($order, $this->user, $order_number);
        $order->status = 0;
        $order->save();

        send_email_order_vendor($order);
        send_email_order_admin($order);
        send_email_order_customer($order);

        return redirect()->route('katalog.monitoring.order.detail', [$this->user->group->code, Crypt::encryptString($order_number)]);
    }

    public function finish(Request $request, $code, $hash) {
        $order_number = Crypt::decryptString($hash);
        $order = new Order;
        $order->setConnection('mysql');
        $order = $this->monitoringRepository->get_order_by_order_number($order, $this->user, $order_number);
        $order->status = 2;
        $order->save();

        return redirect()->route('katalog.monitoring.order.detail', [$this->user->group->code, Crypt::encryptString($order_number)]);
    }
}
