<?php

use App\Cart\Cart;
use App\Order\Order;
use App\PO\po;
use App\Vendor\VendorMaster;
use App\Customer\Customer;
use App\Product\Product;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

if (! function_exists('count_cart')) {
    function count_cart($user) {
        $cart_count = new Cart;
        $cart_count->setConnection('mysql');
        $cart_count = $cart_count->where('buyer_from', $user->group->code)
            ->where('status', 0)
            ->orderBy('cart_number', 'asc')
            ->orderBy('buyer_name', 'asc')
            ->orderBy('updated_at', 'desc');
        return $cart_count->count();
    }
}

if (! function_exists('count_order')) {
    function count_order($user) {
        $order_count = new Order;
        $order_count->setConnection('mysql');
        $order_count = $order_count->where('order_from', $user->group->code)
            ->orderBy('cart_number', 'asc')
            ->orderBy('order_number', 'asc')
            ->orderBy('updated_at', 'desc');
        return $order_count->count();
    }
}

if (! function_exists('count_po')) {
    function count_po($user) {
        $po_count = new po;
        $po_count->setConnection('mysql');
        $po_count = $po_count->where('po_from', $user->group->code)
            ->orderBy('po_number', 'asc')
            ->orderBy('order_number', 'asc')
            ->orderBy('updated_at', 'desc');
        return $po_count->count();
    }
}

if (! function_exists('count_vendor')) {
    function count_vendor($user) {
        $vendor_count = new VendorMaster;
        $vendor_count->setConnection('mysql');
        $vendor_count_all = $vendor_count->where('group_id', $user->group_id);
        $vendor_count_aktif = $vendor_count->where('group_id', $user->group_id)->where('status', 1);
        $vendor_count_tidak_aktif = $vendor_count->where('group_id', $user->group_id)->where('status', 0);
        return [
            'all' => $vendor_count_all->count(),
            'aktif' => $vendor_count_aktif->count(),
            'tidak_aktif' => $vendor_count_tidak_aktif->count()
        ];
    }
}

if (! function_exists('count_customer')) {
    function count_customer($user) {
        $customer_count = new Customer;
        $customer_count->setConnection('mysql');
        $customer_count_all = $customer_count->where('group_id', $user->group_id);
        $customer_count_aktif = $customer_count->where('group_id', $user->group_id)->where('status', 1);
        $customer_count_tidak_aktif = $customer_count->where('group_id', $user->group_id)->where('status', 0);
        return [
            'all' => $customer_count_all->count(),
            'aktif' => $customer_count_aktif->count(),
            'tidak_aktif' => $customer_count_tidak_aktif->count()
        ];
    }
}

if (! function_exists('count_product')) {
    function count_product($user) {
        $product_count = new Product;
        $product_count = $product_count->setConnection($user->group->katalog);
        $product_count = $product_count->where('status', 1);
        return $product_count->count();
    }
}