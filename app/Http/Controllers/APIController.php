<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order\Order;
use App\Order\OrderNotes;
use Illuminate\Support\Facades\Crypt;
use DB;

class APIController extends Controller {

    public function order(Request $request, $code, $hash) {
        // $orders = Crypt::decryptString($hash);
        $orders = $hash;
        if($orders == 'order')
        DB::setDefaultConnection('mysql');
        $order = Order::with(['customer', 'order_status'])
        ->when($request->keyword, function ($query) use ($request) {
            $query->where('order_number', 'like', "%{$request->keyword}%")
            ->orWhere('name', 'like', "%{$request->keyword}%")
            ->orWhere('no_pr', 'like', "%{$request->keyword}%")
            ->orWhere('vendor_name', 'like', "%{$request->keyword}%");
        })
        ->when($request->filter_year, function ($query) use ($request) {
            $query->where(DB::raw('YEAR(created_at)'), $request->filter_year);
        })
        ->where('order_from', $code)
        ->orderBy('updated_at', 'desc')
        ->paginate(20);
        $order->appends($request->only('keyword'));

        if($request->has('filter_year')) {
            $year = Order::select(DB::raw('YEAR(created_at) as years'))->where('order_from', $code)->distinct()->get();
            $years = Order::select(DB::raw('MONTH(created_at) as years'))->where(DB::raw('YEAR(created_at)'), $request->filter_year)->where('order_from', $code)->distinct()->get();
            $all = [];
            foreach($years as $y) {
                if($y->years == '1') {
                    $day = 'Januari';
                } else if($y->years == '2') {
                    $day = 'Februari';
                } else if($y->years == '3') {
                    $day = 'Maret';
                } else if($y->years == '4') {
                    $day = 'April';
                } else if($y->years == '5') {
                    $day = 'Mei';
                } else if($y->years == '6') {
                    $day = 'Juni';
                } else if($y->years == '7') {
                    $day = 'Juli';
                } else if($y->years == '8') {
                    $day = 'Agustus';
                } else if($y->years == '9') {
                    $day = 'September';
                } else if($y->years == '10') {
                    $day = 'Oktober';
                } else if($y->years == '11') {
                    $day = 'November';
                } else if($y->years == '12') {
                    $day = 'Desember';
                }
                array_push($all, [
                    ''. $day .'',
                    Order::where(DB::raw('MONTH(created_at)'), $y->years)->where('order_from', $code)->count()
                ]);
            }
        } else {
            $year = Order::select(DB::raw('YEAR(created_at) as years'))->where('order_from', $code)->distinct()->get();
            $all = [];
            foreach($year as $y) {
                array_push($all, [
                    ''. $y->years .'',
                    Order::where(DB::raw('YEAR(created_at)'), $y->years)->where('order_from', $code)->count()
                ]);
            }
        }

        $total = Order::where('order_from', $code)->count();

        return response()->json([
            'order' => $order,
            'year' => $year,
            'all' => $all,
            'total' => $total,
            'filter_year' => $request->filter_year
        ], 200);
    }
}
