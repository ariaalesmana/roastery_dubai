<?php

namespace Modules\Katalog\Repositories;

use Auth;
use DB;
use App\Cart\Cart;
use App\Product\ProductShipping;
use App\Cart\CartShipping;
use App\Group\group;
use App\Order\Order;

class MonitoringRepository {

    public function get_order_by_user($orders, $user) {
        if($orders == 'order')
        DB::setDefaultConnection($user->group()->first()->katalog);
        $order = new Order;
        $order->setConnection('mysql');
        $data = $order->where('order_by', $user->id)->get();
        return $data;
    }

    public function get_order_detail($order) {
        $data['data'] = $order->order_detail()->where('order_id', $order->id);
        $data['vendor'] = $order->order_detail()->select('vendor_id', 'vendor_name', 'product_from')->where('order_id', $order->id);
        return $data;
    }

    public function get_order_by_order_number($order, $user, $order_number) {
        $data = $order->where('order_number', $order_number)
            ->where('order_by', $user->id)
            ->first();
        return $data;
    }
}