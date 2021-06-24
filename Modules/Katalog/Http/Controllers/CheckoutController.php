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
use App\Order\OrderShipping;
use App\Order\OrderAddress;
use App\Notification\notification;
use Illuminate\Support\Facades\Crypt;
use Modules\Katalog\Repositories\CheckoutRepository;

class CheckoutController extends LayoutController {
    function __construct(CheckoutRepository $checkoutRepository) {
        $this->middleware('auth');
        $this->middleware('permission:customer', ['only' => ['add_to_cart', 'get_data_cart']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
        $this->checkoutRepository = $checkoutRepository;
    }

    public function index(Request $request) {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $data = $this->checkoutRepository->get_checkout($this->user, $request);
        return view('katalog::product.checkout.index',[
			'cart' => $data, 
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => $this->user->group()->first()->code
		]);
    }

    public function add_order(Request $request) {
        $save = false;
        $order_number = date("mYdsiH");
        $order = $this->checkoutRepository->create_order($order_number, $this->user, $request);
        $post["status"] = $order;
		return redirect()->route('katalog.monitoring.order', [$this->user->group()->first()->code, Crypt::encryptString('order')]);
    }
    
}
