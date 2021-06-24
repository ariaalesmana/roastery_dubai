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
use App\Compare\Comparison;
use App\Style\style;
use Illuminate\Support\Facades\Crypt;
use Modules\Katalog\Repositories\ComparisonRepository;

class ComparisonController extends LayoutController {
    function __construct(ComparisonRepository $comparisonRepository) {
        $this->middleware('auth');
        $this->middleware('permission:customer', ['only' => ['add_to_cart', 'get_data_cart']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
        $this->comparisonRepository = $comparisonRepository;
    }

    public function index(Request $request, $code, $hash) {
        $comparisons = Crypt::decryptString($hash);
        $data = $this->comparisonRepository->get_comparison($comparisons, $this->user);
		return view('katalog::product.comparison',[
			'data' => $data, 
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => $this->user->group->code 
        ]);
    }

    public function get_data_comparison(Request $request) {
        $datacomparison = $this->comparisonRepository->get_data_comparison_calculate($request->user_id);
		echo json_encode($datacomparison);
    }

    public function add_to_comparison(Request $request) {
        $comparison = $this->comparisonRepository->add_comparison($request, $this->user);
        $post["status"] = $comparison;
        echo json_encode($post);
    }

    public function delete_comparison(Request $request) {
		$id_comparison = $request->idcomparison;
		$deleteComparison = Comparison::find($id_comparison);
        $deleteComparison->status =  2;
        $deleteComparison->deleted_at = date("Y-m-d H:i:s");
        $deleteComparison->updated_at = date("Y-m-d H:i:s");
        $deleteComparison->save();
		echo json_encode($deleteComparison);
	}
}
