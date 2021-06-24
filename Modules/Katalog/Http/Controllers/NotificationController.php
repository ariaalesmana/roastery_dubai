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
use App\Notification\notification;

class NotificationController extends Controller {
    
    function __construct() {
        $this->middleware('permission:customer', ['only' => ['get_data_notification']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function get_data_notification(Request $request) {

        $datanotification['data'] = notification::where('user_id', $this->user->id)
            ->where('user_type', 'customer')
            ->where('user_from', $this->user->group()->first()->code)
            ->get();

        $datanotification['dataCount'] = notification::where('user_id', $this->user->id)
            ->where('user_type', 'customer')
            ->where('user_from', $this->user->group()->first()->code)
            ->where('is_read', 0)
            ->get();
		
		$count = 0;
		foreach ($datanotification['dataCount'] as $d) {
			$count++;
		}
		$datanotification['count'] = $count;
		
		echo json_encode($datanotification);
    }
}
