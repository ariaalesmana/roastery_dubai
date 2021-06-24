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
use App\Style\style;
use App\Product\ProductShipping;
use App\Cart\CartShipping;
use App\Order\Order;
use App\Order\OrderDetail;
use App\Order\OrderShipping;
use App\Order\OrderAddress;
use App\Notification\notification;
use App\PO\po;
use App\PO\PoDetail;
use App\PO\PoDetailBiaya;
use App\PO\PoTotalJumlahTanpaPpn;
use App\PO\PoTotalHargaSatuanFinalTanpaPpn;
use App\PO\PoTotalHargaTotalFinalTanpaPpn;
use App\Vendor\VendorMaster;
use PDF;
use Illuminate\Support\Facades\Crypt;
use Modules\Katalog\Repositories\MonitoringRepository;

class POController extends LayoutController {

    function __construct(MonitoringRepository $monitoringRepository) {
        $this->middleware('auth');
        $this->middleware('permission:customer', ['only' => ['create_po']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
        $this->monitoringRepository = $monitoringRepository;
    }

    public function index(Request $request, $code, $hash) {
        $pos = Crypt::decryptString($hash);
        if($pos == 'po')
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $po = new po;
        $po->setConnection('mysql');
        $po = $po->where('po_by', $this->user->id)->get();
        return view('katalog::monitoring.po.index',[
			'po' => $po, 
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => $this->user->group()->first()->code
		])->with('search', $request->input('search'));
    }

    public function detail_po(Request $request, $code, $hash_id) {
        $id = Crypt::decryptString($hash_id);
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $po = new po;
        $po->setConnection('mysql');
        $po = $po->find($id);
        return view('katalog::monitoring.po.detail',[
			'po' => $po, 
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => $this->user->group()->first()->code
		])->with('search', $request->input('search'));
    }

    public function create_po(Request $request, $code, $hash) {
        $order_number = Crypt::decryptString($hash);
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $order = new Order;
        $order->setConnection('mysql');
        $order = $this->monitoringRepository->get_order_by_order_number($order, $this->user, $order_number);
        $data = $this->monitoringRepository->get_order_detail($order);
        return view('katalog::monitoring.po.create_po',[
            'order' => $order,
			'data' => $data, 
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => $this->user->group()->first()->code
		])->with('search', $request->input('search'));
    }

    public function post_po(Request $request) {
        $save = false;
        $po = create_po($this->user, $request);
        if ($po) {
            $save = true;
        } else {
            $save = false;
        }
        if ($save) {
            $post["status"] = true;
			return redirect()->route('katalog.monitoring.po.index', [$this->user->group()->first()->code, Crypt::encryptString('po')]);
		} else {
            $post["status"] = false;
			return redirect()->route('katalog.monitoring.po.index', [$this->user->group()->first()->code, Crypt::encryptString('po')]);
		}
    }

    public function cetakpdf(Request $request, $code, $po_id) {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $po = new po;
        $po->setConnection('mysql');
        $po = $po->find($po_id);
        $pdf = PDF::loadView('katalog::monitoring.po.pdf', [
            'po' => $po
        ]);
        // dd(storage_path().'/app/files/PO/'.'_' . $po_id . '.pdf');
        // /home/ubuntu/sites/coffee-dubai/storage/app/public/files/PO
        $pdf->save(storage_path().'/app/public/files/PO/'.'_' . $po_id . '.pdf');
        return $pdf->download($po_id . '.pdf');
    }
}
