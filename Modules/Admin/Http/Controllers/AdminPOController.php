<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Http\Controllers\LayoutController;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\PO\po;
use Illuminate\Support\Facades\Crypt;
use PDF;

class AdminPOController extends LayoutController {
    function __construct() {
        $this->middleware('permission:administrator', ['only' => ['index']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request, $code, $hash) {
        $pos = Crypt::decryptString($hash);
        if($pos == 'adminpo')
        $po = po::where('po_from', $this->user->group->code)
            ->orderBy('po_number', 'asc')
            ->orderBy('order_number', 'asc')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return view('admin::orders.po.purchase_order', [
            'po' => $po, 
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function search(Request $request, $code) {
        $po = po::where('po_from', $this->user->group->code)
            ->where('po_number', 'like', '%' .$request->q. '%')
            ->orWhere('nama_pekerjaan', 'like', '%' .$request->q. '%')
            ->orWhere('no_pr', 'like', '%' .$request->q. '%')
            ->orWhere('po_date', 'like', '%' .$request->q. '%')
            ->orderBy('po_number', 'asc')
            ->orderBy('order_number', 'asc')
            ->orderBy('updated_at', 'desc');
        return view('admin::orders.po.purchase_order',[
            'po' => $po->paginate(10),
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function show(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        $po = po::find($id);
        return view('admin::orders.po.detail_purchase_order',[
            'po' => $po,
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function cetakpdf(Request $request, $code, $po_id) {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $po = new po;
        $po->setConnection('mysql');
        $po = $po->find($po_id);
        $pdf = PDF::loadView('katalog::monitoring.po.pdf', [
            'po' => $po
        ]);
        // $pdf->save(storage_path().'/app/public/files/PO/'.'_' . $po_id . '.pdf');
        $pdf->save(storage_path().'/app/public/files/PO/'.'_' . $po_id . '.pdf');
        return $pdf->download($po_id . '.pdf');
    }
}
