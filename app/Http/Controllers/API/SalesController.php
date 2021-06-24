<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SummarySales;
use App\Sales;
use Auth;
use DB;

class SalesController extends Controller {
    public $successStatus = 401;

    function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index() {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $this->successStatus = 200;
        $success['success'] = true;
        $success['sales'] = Sales::all();
        return response()->json($success, $this->successStatus);
    }

    public function add(Request $request) {
        DB::setDefaultConnection($this->user->group()->first()->katalog);

        $sales = new Sales;
        $sales->date = $request->date;
        $sales->no_do = $request->no_do;
        $sales->buyer = $request->buyer;
        $sales->price = $request->price;
        $sales->mount_sugar_sold_cane = $request->cane;
        $sales->mount_sugar_sold_rs = $request->rs;
        $sales->save();

        // summary
        // check data Sales
        $check = SummarySales::where('date', 'like', '%'.$request->date.'%')->first(); // check apakah sudah ada data dengan tanggal yang sama dengan yang diinput
        if($check){ // jika data sudah ada
            $summary = $check;
        } else {
            $summary = new SummarySales;
        }

        // insert for summary Sales
        $price = Sales::where('date', 'like', '%'.$request->date.'%')->sum('price');
        $cane = Sales::where('date', 'like', '%'.$request->date.'%')->sum('mount_sugar_sold_cane');
        $rs = Sales::where('date', 'like', '%'.$request->date.'%')->sum('mount_sugar_sold_rs');

        // update database
        $summary->date = $request->date;
        $summary->price = $price;
        $summary->cane = $cane;
        $summary->rs = $rs;
        $summary->save();
        // end summary

        $this->successStatus = 200;
        $success['success']  = true;
        $success['data']     = $sales;

        return response()->json($success, $this->successStatus);
    }

    public function summary() {
        DB::setDefaultConnection($this->user->group()->first()->katalog);

        $arr = [];
        $valCane = [];
        $valRs = [];
        $valDate = [];

        foreach(SummarySales::select(DB::raw('date'))->distinct()->orderBy('date', 'asc')->get()->pluck('date') as $d){
            array_push($valCane, SummarySales::where('date', $d)->orderBy('date', 'desc')->sum('cane'));
            array_push($valRs, SummarySales::where('date', $d)->orderBy('date', 'desc')->sum('rs'));
            array_push($valDate, date('d-M-Y', strtotime($d)));
        }

        // pie chart
        $buyer = Sales::select(DB::raw('buyer'))->orderBy('buyer', 'asc')->get()->count();
        $pt = Sales::where('buyer', 'like', '%, PT%')->orderBy('buyer', 'asc')->get()->count();
        $cv = Sales::where('buyer', 'like', '%, CV%')->orderBy('buyer', 'asc')->get()->count();
        $koperasi = Sales::where('buyer', 'like', '%koperasi%')->orderBy('buyer', 'asc')->get()->count();
        $perkumpulan = Sales::where('buyer', 'like', '%perkumpulan%')->orderBy('buyer', 'asc')->get()->count();
        $individu = Sales::where('buyer', 'not like', '%perkumpulan%')->
        where('buyer', 'not like', '%, PT%')->
        where('buyer', 'not like', '%, CV%')->
        where('buyer', 'not like', '%Koperasi%')->
        orderBy('buyer', 'asc')->get()->count();

        $piePT = $pt / $buyer * 100;
        $pieCV = $cv / $buyer * 100;
        $pieKoperasi = $koperasi / $buyer * 100;
        $piePerkumpulan = $perkumpulan / $buyer * 100;
        $pieIndividu = $individu / $buyer * 100;

        $pieVal = [round($piePT), round($pieCV), round($pieKoperasi), round($piePerkumpulan), round($pieIndividu)];
        $pieBuyer = ['pt', 'cv', 'koperasi', 'perkumpulan', 'individu'];

        $this->successStatus = 200;
        $success['success'] = true;
        $success['pieVal'] = $pieVal;
        $success['pieBuyer'] = $pieBuyer;
        // $success['summarySales'] = SummarySales::alls();
        $success['summarySales'] = SummarySales::orderBy('date', 'desc')->get();
        $success['date'] = $valDate;
        $success['cane'] = $valCane;
        $success['rs'] = $valRs;

        return response()->json($success, $this->successStatus);
    }
}
