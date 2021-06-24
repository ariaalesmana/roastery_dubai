<?php

namespace Modules\Katalog\Repositories;

use Auth;
use DB;
use App\Compare\Comparison;

class ComparisonRepository {

    public function get_comparison($comparisons, $user) {
        if($comparisons == 'comparison')
        DB::setDefaultConnection($user->group()->first()->katalog);
        $comparison = new Comparison;
        $comparison->setConnection('mysql');
        $data = $comparison->where('buyer_id', $user->id)->where('status', 0);
        return $data;
    }

    public function get_data_comparison_calculate($user) {
        $data['data'] = Comparison::where('buyer_id', $user)->where('status', 0)->get();
		$totalprice = 0;
		$count = 0;
		foreach ($data['data'] as $d) {
			$count++;
			$totalprice = $totalprice + $d->price;
		}
		$data['total'] = $totalprice;
		$data['count'] = $count;
        return $data;
    }

    public function add_comparison($request, $user) {
        $getComparison = Comparison::where('product_from', $request->product_from)
            ->where('product_id', '=', $request->product_id)->where('status', 0)
            ->where('buyer_id', $user->id)
            ->get();

        if ($getComparison->isEmpty()) {
            $compare = new Comparison();
            $compare->product_id =  $request->product_id;
            $compare->product_from =  $request->product_from;
            $compare->name =  $request->name;
            $compare->image =  $request->image;
            $compare->price =  $request->price;
            $compare->unit =  $request->unit;
            $compare->sku =  $request->sku;
            $compare->vendor_sku =  $request->vendor_sku;
            $compare->vendor_id =  $request->vendor_id;
            $compare->vendor_name =  $request->vendor_name;
            $compare->vendor_email =  $request->vendor_email;
            $compare->buyer_id =  $user->id;
            $compare->buyer_name =  $user->first_name;
            $compare->buyer_email =  $user->email;
            $compare->status =  0;
            $compare->created_at = date("Y-m-d H:i:s");
            $compare->updated_at = date("Y-m-d H:i:s");
            $compare->save();   
        }
        return true;
    }
}