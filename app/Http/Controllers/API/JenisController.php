<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Jenis;
use App\Biji;
use App\Proses;
use App\Unit;
use DB;

class JenisController extends Controller
{
    public $successStatus = 401;

    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $this->successStatus = 200;
        $success['success'] = true;
        $success['jenis']   = Jenis::all();
        $success['biji']   = Biji::all();
        $success['proses']   = Proses::all();
        $success['unit']   = Unit::all();

        return response()->json($success, $this->successStatus);
    }

    public function detail(Request $request, $id)
    {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $this->successStatus = 200;
        $success['success'] = true;
        $success['jenis']   = Jenis::find($id);

        return response()->json($success, $this->successStatus);
    }

    public function delete(Request $request, $id)
    {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $jenis = Jenis::find($id);
        $jenis->delete();
        $this->successStatus = 200;
        $success['success'] = true;
        return response()->json($success, $this->successStatus);
    }

    public function add(Request $request)
    {
        $jenis = new Jenis();
        $jenis = $jenis->setConnection($this->user->group->katalog);
        $jenis->nama_jenis      = $request->nama_jenis;
        $jenis->deskripsi_jenis = $request->deskripsi_jenis;
        $jenis->save();

        $this->successStatus = 200;
        $success['success']  = true;
        $success['data']     = $jenis;

        return response()->json($success, $this->successStatus);
    }
}
