<?php

use App\Notification\notification;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

if (! function_exists('get_vendor_notification')) {
    function get_vendor_notification($user) {
        $notification = new notification;
        $notification->setConnection('mysql');
        $notification = $notification
            ->where('user_type', 'vendor')
            ->where('product_from', $user->group->code)
            ->where('vendor_id', $user->vendor_katalog_id);
        return [
            'total' => $notification->where('is_read', 0)->orderBy('updated_at', 'DESC')->count(),
            'notification' => $notification->orderBy('is_read', 'ASC')->orderBy('updated_at', 'DESC')->get(),
        ];
        return $notification;
    }
}