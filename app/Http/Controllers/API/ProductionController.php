<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Production;
use App\ProductionMilledSugarCane;
use App\ProductionSugarCane;
use App\ProductionProcessedRs;
use App\ProductionSugarFromRs;
use Auth;
use DB;

class ProductionController extends Controller {
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
        // $success['production']   = Production::all();
        $success['milledSugarCane']   = ProductionMilledSugarCane::orderBy('created_at', 'desc')->get();
        $success['processedRS']   = ProductionProcessedRs::orderBy('created_at', 'desc')->get();
        $success['sugarCane']   = ProductionSugarCane::orderBy('created_at', 'desc')->get();
        $success['sugarFromRS']   = ProductionSugarFromRs::orderBy('created_at', 'desc')->get();
        // $success['milledSugarCane']   = ProductionMilledSugarCane::where('milled_sugar_cane', '!=', NULL)->get();
        // $success['processedRS']   = ProductionProcessedRS::where('processed_rs', '!=', NULL)->get();
        // $success['sugarCane']   = ProductionSugarCane::where('sugar_cane', '!=', NULL)->get();
        // $success['sugarFromRS']   = ProductionSugarFromRS::where('sugar_from_rs', '!=', NULL)->get();

        return response()->json($success, $this->successStatus);
    }

    public function add(Request $request) {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        if($request->param == 'milledSugarCane'){
            $production = new ProductionMilledSugarCane();
        } else if($request->param == 'processedRs'){
            $production = new ProductionProcessedRs();
        } else if($request->param == 'sugarCane'){
            $production = new ProductionSugarCane();
        } else if($request->param == 'sugarFromRs'){
            $production = new ProductionSugarFromRS();
        } else {
            return false;
        }
        $production->date = $request->date;
        $production->volume = $request->volume;
        $production->save();

        // insert for summary production
        $milledSugarCane = ProductionMilledSugarCane::where('date', 'like', '%'.$request->date.'%')->sum('volume');
        $processedRs = ProductionProcessedRs::where('date', 'like', '%'.$request->date.'%')->sum('volume');
        $sugarCane = ProductionSugarCane::where('date', 'like', '%'.$request->date.'%')->sum('volume');
        $sugarFromRs = ProductionSugarFromRs::where('date', 'like', '%'.$request->date.'%')->sum('volume');
        // check data production
        $check = Production::where('date', 'like', '%'.$request->date.'%')->first(); // check apakahsudah ada data dengan tanggal yang sama dengan yang diinput
        if($check){ // jika data sudah ada
            $summary = $check;
        } else {
            $summary = new Production;
        }
        $summary->date = $request->date;
        $summary->milled_sugar_cane = $milledSugarCane;
        $summary->processed_rs = $processedRs;
        $summary->sugar_cane = $sugarCane;
        $summary->sugar_from_rs = $sugarFromRs;
        $summary->save();
        // end summary

        $this->successStatus = 200;
        $success['success']  = true;
        $success['data']     = $production;

        return response()->json($success, $this->successStatus);
    }

    public function summary() {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $this->successStatus = 200;
        $success['success'] = true;

        $interval = 0;
        $valDate = [];
        $valMSC = [];
        $valPRS = [];
        $valSC = [];
        $valSFRS = [];

        $akhir = Production::orderBy('date', 'desc')->first()->date;
        // looping all data production
        foreach(Production::orderBy('date', 'asc')->get() as $d){ // urutkan ascending
            $i = $interval++;
            // setting agar tiap 14x looping maka interval menjadi 0
            if ($i == 13){
                $interval = 0;
            }

            // setting jika interval 0 maka ambil data
            if ($i == 0 || $d->date == $akhir){
                array_push($valDate, date('d-M-Y', strtotime($d->date)));
                array_push($valMSC, $d->milled_sugar_cane);
                array_push($valPRS, $d->processed_rs);
                array_push($valSC, $d->sugar_cane);
                array_push($valSFRS, $d->sugar_from_rs);
            }
        }
        
        // $success['summaryProduction'] = Production::all();
        $success['summaryProduction'] = Production::orderBy('date', 'desc')->get();
        $success['date'] = $valDate;
        $success['msc'] = $valMSC;
        $success['prs'] = $valPRS;
        $success['sc'] = $valSC;
        $success['sfrs'] = $valSFRS;

        return response()->json($success, $this->successStatus);
    }
}
