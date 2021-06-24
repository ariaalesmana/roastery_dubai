<?php

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Jobs\OrderEmailJob;
use App\Jobs\OrderEmailAdminJob;
use App\Jobs\OrderEmailCustomerJob;
use App\Jobs\KonfirmasiOrderEmailJob;
use App\Jobs\KonfirmasiOrderEmailAdminJob;
use App\Vendor\vendor;
use App\Group\group;
use Faker\Factory as Faker;

if (! function_exists('send_email_order_vendor')) {
    function send_email_order_vendor($order) {
        $group = new group;
        $group = $group->setConnection('mysql');
        $group = $group->where('code', $order->vendor_from)->first();
        $vendor = new vendor;
        $vendor = $vendor->setConnection($group->katalog);
        $vendor = $vendor->where('id', $order->vendor_id)->first();
        dispatch(new OrderEmailJob($vendor, $order, $group));
        return true;
    }
}

if (! function_exists('send_email_order_admin')) {
    function send_email_order_admin($order) {
        $group = new group;
        $group = $group->setConnection('mysql');
        $group = $group->where('code', $order->vendor_from)->first();
        $vendor = new vendor;
        $vendor = $vendor->setConnection($group->katalog);
        $vendor = $vendor->where('id', $order->vendor_id)->first();
        dispatch(new OrderEmailAdminJob($vendor, $order, $group));
        return true;
    }
}

if (! function_exists('send_email_order_customer')) {
    function send_email_order_customer($order) {
        $group = new group;
        $group = $group->setConnection('mysql');
        $group = $group->where('code', $order->vendor_from)->first();
        $vendor = new vendor;
        $vendor = $vendor->setConnection($group->katalog);
        $vendor = $vendor->where('id', $order->vendor_id)->first();
        dispatch(new OrderEmailCustomerJob($vendor, $order, $group));
        return true;
    }
}

if (! function_exists('send_email_order_konfirmasi')) {
    function send_email_order_konfirmasi($order) {
        $group = new group;
        $group = $group->setConnection('mysql');
        $group = $group->where('code', $order->vendor_from)->first();
        $vendor = new vendor;
        $vendor = $vendor->setConnection($group->katalog);
        $vendor = $vendor->where('id', $order->vendor_id)->first();
        dispatch(new KonfirmasiOrderEmailJob($vendor, $order, $group));
        return true;
    }
}

if (! function_exists('send_email_order_konfirmasi_admin')) {
    function send_email_order_konfirmasi_admin($order) {
        $group = new group;
        $group = $group->setConnection('mysql');
        $group = $group->where('code', $order->vendor_from)->first();
        $vendor = new vendor;
        $vendor = $vendor->setConnection($group->katalog);
        $vendor = $vendor->where('id', $order->vendor_id)->first();
        dispatch(new KonfirmasiOrderEmailAdminJob($vendor, $order, $group));
        return true;
    }
}