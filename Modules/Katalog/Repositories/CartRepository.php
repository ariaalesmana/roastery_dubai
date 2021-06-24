<?php

namespace Modules\Katalog\Repositories;

use Auth;
use DB;
use App\Cart\Cart;
use App\Product\ProductShipping;
use App\Cart\CartShipping;
use App\Group\group;

class CartRepository {

    public function get_cart($carts, $user) {
        if($carts == 'cart')
        DB::setDefaultConnection($user->group()->first()->katalog);
        $cart = new Cart;
        $cart->setConnection('mysql');
        $data['data'] = $cart->where('buyer_id', $user->id)->where('status', 0);
        $data['vendor'] = $cart->select('vendor_id', 'vendor_name', 'product_from')->where('buyer_id', $user->id)->where('status', 0);
        return $data;
    }

    public function get_data_cart_calculate($user) {
        $data['data'] = Cart::where('buyer_id', $user->id)->where('status', 0)->get();
        $totalprice = 0;
		$count = 0;
		foreach ($data['data'] as $d) {
			$count++;
			$totalprice = $totalprice + ($d->price * $d->qty);
		}
		$data['total'] = $totalprice;
        $data['count'] = $count;
        return $data;
    }

    public function get_cart_by_product($request, $user) {
        $cart = Cart::where('product_from', $request->product_from)
            ->where('product_id', $request->product_id)
            ->where('buyer_id', $user->id)
            ->where('status', 0)
            ->get();
        return $cart;
    }

    public function get_cart_number($request, $user) {
        $cart = Cart::where('buyer_id', $user->id)->first();
        return $cart;
    }

    public function get_cart_by_user($request, $user) {
        $cart = Cart::where('buyer_id', $user->id)
            ->where('status', 0)
            ->get();
        return $cart;
    }

    public function add_cart($request, $user) {
        $qty = $request->qty;
        $getCartByUser = $this->get_cart_by_user($request, $user);
        if (!$qty ) {
            $qty = 1;
        }
        $cart_number = date("mYdsiH");
        $cart = new Cart();
        if ($getCartByUser->isEmpty()) {
            $cart->cart_number =  $cart_number;
        } else {
            $getCartNumber = $this->get_cart_number($request, $user);
            $cart->cart_number =  $getCartNumber->cart_number;
        }
        $cart->product_id = $request->product_id;
        $cart->product_from = $request->product_from;
        $cart->name = $request->name;
        $cart->image = $request->image;
        $cart->qty = $qty;
        $cart->price = $request->price;
        $cart->unit = $request->unit;
        $cart->sku = $request->sku;
        $cart->vendor_sku = $request->vendor_sku;
        $cart->vendor_id = $request->vendor_id;
        $cart->vendor_name = $request->vendor_name;
        $cart->vendor_email = $request->vendor_email;
        $cart->buyer_id =  $user->id;
        $cart->buyer_name =  $user->first_name;
        $cart->buyer_email =  $user->email;
        $cart->buyer_from =  $user->group->code;
        $cart->status =  0;
        $cart->save();

        return $this->add_cart_shipping($cart, $request, $user);
    }

    public function add_cart_shipping($cart, $request, $user) {
        $getCartByUser = $this->get_cart_by_user($request, $user);
        $prod_shipping = new ProductShipping;
        $prod_shipping->setConnection(group::where('code', $request->product_from)->first()->katalog);
        $product_shipping = $this->get_shipping($prod_shipping, $request);
        foreach($product_shipping as $ps) {
            $cart_shipping = new CartShipping();
            $cart_shipping->cart_id = $cart->id;
            if ($getCartByUser->isEmpty()) {
                $cart_shipping->cart_number =  $cart_number;
            } else {
                $getCartNumber = $this->get_cart_number($request, $user);
                $cart_shipping->cart_number =  $getCartNumber->cart_number;
            }
            $cart_shipping->product_id = $ps->product_id;
            $cart_shipping->name = $ps->name;
            $cart_shipping->price = $ps->price;
            $cart_shipping->status = 0;
            $cart_shipping->save();
        }
        return true;
    }

    public function get_shipping($prod_shipping, $request) {
        $shipping = $prod_shipping->where('product_id', $request->product_id)->get();
        return $shipping;
    }

    public function update_add_cart($getCart, $request) {
        $qty = $request->qty;
        $cart_id = $getCart[0]->id;
        if (!$qty ) {
            $qty = 1;
        }
        $quantity = $getCart[0]->qty + $qty;
        $cart = Cart::find($cart_id);
        $cart->qty = $quantity;
        $cart->save();
        return true;
    }
}