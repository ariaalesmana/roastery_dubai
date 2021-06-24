<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Logistic;
use App\LogisticStockOutBulkSugar;
use App\LogisticStockBulkSugarFromCane;
use App\LogisticStockBulkSugarFromRs;
use App\LogisticReturnBulkSugar;
use Auth;
use DB;

class LogisticController extends Controller {
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
        // $success['logistic']   = Logistic::all();
        $success['stockBulkSugarFromCane']   = LogisticStockBulkSugarFromCane::all();
        $success['stockBulkSugarFromRs']   = LogisticStockBulkSugarFromRs::all();
        $success['stockOutBulkSugar']   = LogisticStockOutBulkSugar::all();
        $success['returnBulkSugar']   = LogisticReturnBulkSugar::all();
        // $success['stockBulkSugarFromCane']   = LogisticStockBulkSugarFromCane::where('milled_sugar_cane', '!=', NULL)->get();
        // $success['stockBulkSugarFromRs']   = LogisticStockBulkSugarFromRs::where('processed_rs', '!=', NULL)->get();
        // $success['stockOutBulkSugar']   = LogisticStockOutBulkSugar:: where('sugar_cane', '!=', NULL)->get();
        // $success['returnBulkSugar']   = LogisticReturnBulkSugar::where('sugar_from_rs', '!=', NULL)->get();

        return response()->json($success, $this->successStatus);
    }

    public function add(Request $request) {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        if($request->param == 'stockBulkSugarFromCane'){
            $logistic = new LogisticStockBulkSugarFromCane();
        } else if($request->param == 'stockBulkSugarFromRs'){
            $logistic = new LogisticStockBulkSugarFromRs();
        } else if($request->param == 'stockOutBulkSugar'){
            $logistic = new LogisticStockOutBulkSugar();
        } else if($request->param == 'returnBulkSugar'){
            $logistic = new LogisticReturnBulkSugar();
        } else {
            return false;
        }
        $logistic->date = $request->date;
        $logistic->volume = $request->volume;
        $logistic->save();

        // insert for summary logistic
        $stockBulkSugarFromCane = LogisticStockBulkSugarFromCane::where('date', 'like', '%'.$request->date.'%')->sum('volume');
        $stockBulkSugarFromRs = LogisticStockBulkSugarFromRs::where('date', 'like', '%'.$request->date.'%')->sum('volume');
        $stockOutBulkSugar = LogisticStockOutBulkSugar::where('date', 'like', '%'.$request->date.'%')->sum('volume');
        $returnBulkSugar = LogisticReturnBulkSugar::where('date', 'like', '%'.$request->date.'%')->sum('volume');
        // check data logistic
        $check = Logistic::where('date', 'like', '%'.$request->date.'%')->first(); // check apakahsudah ada data dengan tanggal yang sama dengan yang diinput
        if($check){ // jika data sudah ada
            $summary = $check;
        } else {
            $summary = new Logistic;
        }
        $summary->date = $request->date;
        $summary->stock_bulk_sugar_from_cane = $stockBulkSugarFromCane;
        $summary->stock_bulk_sugar_from_rs = $stockBulkSugarFromRs;
        $summary->stock_out_bulk_sugar = $stockOutBulkSugar;
        $summary->return_bulk_sugar = $returnBulkSugar;
        $summary->save();
        // end summary

        $this->successStatus = 200;
        $success['success']  = true;
        $success['data']     = $logistic;

        return response()->json($success, $this->successStatus);
    }

    public function summary() {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $this->successStatus = 200;
        $success['success'] = true;

        $interval = 0;
        $valDate = [];
        $valLine = [];
        $valSBSFC = [];
        $valSBSFRS = [];
        $valSOBS = [];
        $valRBS = [];

        $akhir = Logistic::orderBy('date', 'desc')->first()->date;
        // looping all data Logistics
        foreach(Logistic::orderBy('date', 'asc')->get() as $l){ // urutkan ascending
            $i = $interval++;
            // setting agar tiap 14x looping maka interval menjadi 0
            if ($i == 13){
                $interval = 0;
            }

            // setting jika interval 0 maka ambil data
            if ($i == 0 || $l->date == $akhir){
                array_push($valDate, date('d-M-Y', strtotime($l->date)));
                array_push($valLine, ($l->stock_bulk_sugar_from_cane ? $l->stock_bulk_sugar_from_cane : 0)+($l->stock_bulk_sugar_from_rs ? $l->stock_bulk_sugar_from_rs : 0)-($l->stock_out_bulk_sugar ? $l->stock_out_bulk_sugar : 0));
                array_push($valSBSFC, $l->stock_bulk_sugar_from_cane);
                array_push($valSBSFRS, $l->stock_bulk_sugar_from_rs);
                array_push($valSOBS, $l->stock_out_bulk_sugar);
                array_push($valRBS, $l->return_bulk_sugar);
            }
        }

        // foreach(Logistic::all() as $l) {
        //     array_push($valDate, date('d-M-Y', strtotime($l->date)));
        //     array_push($valLine, ($l->stock_bulk_sugar_from_cane ? $l->stock_bulk_sugar_from_cane : 0)+($l->stock_bulk_sugar_from_rs ? $l->stock_bulk_sugar_from_rs : 0)-($l->stock_out_bulk_sugar ? $l->stock_out_bulk_sugar : 0));
        // }

        $stacked = Logistic::orderBy('date', 'asc')->get();

        // $success['summaryLogistic'] = Logistic::all();
        $success['summaryLogistic'] = Logistic::orderBy('date', 'desc')->get();
        $success['date'] = $valDate;
        $success['sbsfc'] = $valSBSFC;
        $success['sbsfrs'] = $valSBSFRS;
        $success['line'] = $valLine;
        $success['sobs'] = $valSOBS;
        $success['rbs'] = $valRBS;
        $success['stacked'] = $stacked;

        
        
        // $success['date'] = Logistic::orderBy('date', 'asc')->get()->pluck('date');
        // $success['msc'] = Logistic::orderBy('date', 'asc')->get()->pluck('stock_bulk_sugar_from_cane');
        // $success['prs'] = Logistic::orderBy('date', 'asc')->get()->pluck('stock_bulk_sugar_from_rs');
        // $success['sc'] = Logistic::orderBy('date', 'asc')->get()->pluck('stock_out_bulk_sugar');
        // $success['sfrs'] = Logistic::orderBy('date', 'asc')->get()->pluck('return_bulk_sugar');

        return response()->json($success, $this->successStatus);
    }
}
