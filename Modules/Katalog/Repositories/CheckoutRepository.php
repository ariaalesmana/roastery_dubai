<?php

namespace Modules\Katalog\Repositories;

use Auth;
use DB;
use App\Cart\Cart;
use App\Order\Order;
use App\Order\OrderDetail;
use App\Order\OrderAddress;
use App\Order\OrderShipping;
use App\Notification\notification;

class CheckoutRepository {

    public function get_checkout($user, $request) {
        $cart = new Cart;
        $cart->setConnection('mysql');
        $data['data'] = $cart->where('buyer_id', $user->id)
            ->where('vendor_id', $request->vendor_id)
            ->where('product_from', $request->product_from)
            ->where('status', 0);
        $data['vendor'] = $cart->select('vendor_id', 'vendor_name', 'product_from')
            ->where('buyer_id', $user->id)
            ->where('vendor_id', $request->vendor_id)
            ->where('product_from', $request->product_from)
            ->where('status', 0);
        return $data;
    }

    public function create_order($order_number, $user, $request) {
        $order = new Order();
        $order->cart_number = $request->cart_number;
        $order->order_number = $order_number;
        $order->name = $request->nama_pekerjaan;
        $order->no_pr = $request->no_pr;
        $order->order_by = $user->id;
        $order->order_from = $user->group->code;
        $order->order_total = $request->grandtotal_hide;
        $order->vendor_id = $request->vendor_id;
        $order->vendor_name = $request->vendor_name;
        $order->vendor_from = $request->product_from;
        $order->status = 0;
        $order->save();
        
        return $this->add_order_detail($order, $user, $request);
    }

    public function add_order_detail($order, $user, $request) {
        $getCart = $this->get_cart_number_by_product($user, $request)->get();
        foreach($getCart as $gc) {
            $order_detail = new OrderDetail();
            $order_detail->order_id =  $order->id;
            $order_detail->product_id =  $gc->product_id;
            $order_detail->product_from =  $gc->product_from;
            $order_detail->name =  $gc->name;
            $order_detail->image =  $gc->image;
            $order_detail->qty =  $gc->qty;
            $order_detail->price =  $gc->price;
            $order_detail->unit =  $gc->unit;
            $order_detail->sku =  $gc->sku;
            $order_detail->vendor_sku =  $gc->vendor_sku;
            $order_detail->vendor_id =  $gc->vendor_id;
            $order_detail->vendor_name =  $gc->vendor_name;
            $order_detail->vendor_email =  $gc->vendor_email;
            $order_detail->buyer_id =  $gc->buyer_id;
            $order_detail->buyer_name =  $gc->buyer_name;
            $order_detail->buyer_email =  $gc->buyer_email;
            $order_detail->buyer_from =  $user->group->code;
            $order_detail->status =  0;
            $order_detail->save();
            if($request->has('biayavalue'.$gc->id)) {
                foreach($request->input('biayavalue'.$gc->id) as $index => $bv) {
                    $order_shipping = new OrderShipping();
                    $order_shipping->order_detail_id =  $order_detail->id;
                    $order_shipping->order_id =  $order->id;
                    $order_shipping->product_id =  $gc->product_id;
                    $order_shipping->name =  str_replace(' - Rp. '.number_format($bv, 0), '', $request->input('biayatext'.$gc->id)[$index]);
                    $order_shipping->price =  $bv;
                    $order_shipping->status =  0;
                    $order_shipping->save();
                }
            }
            $gc->cart_shipping()->update([
                'status' => 1
            ]);
            $notification = new notification();
            $notification->order_id = $order->id;
            $notification->order_number = $order->order_number;
            $notification->user_id = $order->order_by;
            $notification->user_type = 'customer';
            $notification->user_from = $order->order_from;
            $notification->title = 'Pemesanan Produk';
            $notification->message = 'Anda melakukan pembelian produk ' . $gc->name;
            $notification->product_from = $order->vendor_from;
            $notification->vendor_id = $order->vendor_id;
            $notification->is_read = 0;
            $notification->status = 0;
            $notification->save();

            $notification = new notification();
            $notification->order_id = $order->id;
            $notification->order_number = $order->order_number;
            $notification->user_id = $order->order_by;
            $notification->user_type = 'vendor';
            $notification->user_from = $order->order_from;
            $notification->title = 'Pemesanan Produk';
            $notification->message = 'Produk ' . $gc->name . ' telah dipesan';
            $notification->product_from = $order->vendor_from;
            $notification->vendor_id = $order->vendor_id;
            $notification->is_read = 0;
            $notification->status = 0;
            $notification->save();

            $notification = new notification();
            $notification->order_id = $order->id;
            $notification->order_number = $order->order_number;
            $notification->user_id = $order->order_by;
            $notification->user_type = 'admin';
            $notification->user_from = $order->order_from;
            $notification->title = 'Pemesanan Produk';
            $notification->message = 'Produk ' . $gc->name . ' telah dipesan';
            $notification->product_from = $order->vendor_from;
            $notification->vendor_id = $order->vendor_id;
            $notification->is_read = 0;
            $notification->status = 0;
            $notification->save();
        }
        return $this->add_order_address($order, $user, $request);
    }

    function add_order_address($order, $user, $request) {
        $getCart = $this->get_cart_number_by_product($user, $request);

        $order_address = new OrderAddress();
        $order_address->order_id = $order->id;
        $order_address->first_name = $request->first_name;
        $order_address->last_name = $request->last_name;
        $order_address->email = $request->email;
        $order_address->company = $request->company;
        $order_address->phone = $request->phone;
        $order_address->fax = $request->fax;
        $order_address->address = $request->address;
        $order_address->city = $request->city;
        $order_address->province = $request->province;
        $order_address->postcode = $request->postcode;
        $order_address->save();

        $getCart->update([
            'status' => 1
        ]);

        send_email_order_vendor($order);
        send_email_order_admin($order);
        send_email_order_customer($order);

        return true;
    }

    public function get_cart_number_by_product($user, $request) {
        $cart = Cart::where('cart_number', $request->cart_number)
            ->where('buyer_id', $user->id)
            ->where('vendor_id', $request->vendor_id)
            ->where('product_from', $request->product_from)
            ->where('status', 0);
        return $cart;
    }
}