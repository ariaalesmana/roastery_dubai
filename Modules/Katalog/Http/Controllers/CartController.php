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
use App\Group\group;
use App\Style\style;
use App\Product\ProductShipping;
use App\Cart\CartShipping;
use Illuminate\Support\Facades\Crypt;
use Modules\Katalog\Repositories\CartRepository;

class CartController extends LayoutController {
    function __construct(CartRepository $cartRepository) {
        $this->middleware('auth');
        $this->middleware('permission:customer', ['only' => ['add_to_cart', 'get_data_cart']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
        $this->cartRepository = $cartRepository;
    }

    public function index(Request $request, $code, $hash) {
        $carts = Crypt::decryptString($hash);
        $data = $this->cartRepository->get_cart($carts, $this->user);
		return view('katalog::product.cart.index',[
			'data' => $data, 
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => $this->user->group()->first()->code
		]);
    }

    public function get_data_cart(Request $request) {
        $datacart = $this->cartRepository->get_data_cart_calculate($this->user);
        echo json_encode([
			'datacart' => $datacart
			]
		);
    }

    public function add_to_cart(Request $request) {
        $save = false;
        $getCart = $this->cartRepository->get_cart_by_product($request, $this->user);
        if ($getCart->isEmpty()) {
            $cart = $this->cartRepository->add_cart($request, $this->user);
            $save = $cart;
        } else {
            $cart = $this->cartRepository->update_add_cart($getCart, $request);
            $save = $cart;
        }
        $post["status"] = $save;
		echo json_encode($post);
    }

    public function update_cart(Request $request) {
        $datacart_id = json_decode($request->post('datacart_id')[0]);
		foreach ($datacart_id as $index => $d) {
			$quantity =  $request->post("qty$d->id");
			$id_cart  =  $d->id;
            $update_cart = Cart::find($id_cart);
            $update_cart->qty = $quantity;
            $update_cart->updated_at = date("Y-m-d H:i:s");
            $update_cart->save();
		}
		return redirect()->route('katalog.cart.index', [$this->user->group()->first()->code, Crypt::encryptString('cart')]);
    }

    public function delete_cart(Request $request) {
		$id_cart = $request->idcart;
		$deleteCart = Cart::find($id_cart);
        $deleteCart->status =  2;
        $deleteCart->deleted_at = date("Y-m-d H:i:s");
        $deleteCart->updated_at = date("Y-m-d H:i:s");
        $deleteCart->save();
        $cart_shipping = CartShipping::where('cart_id', $id_cart)->delete();
		echo json_encode($deleteCart);
	}
}
