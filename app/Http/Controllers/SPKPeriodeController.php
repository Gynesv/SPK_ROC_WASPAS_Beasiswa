<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SistemApp;
use App\Models\ModSPKPeriode;
use DB;

class SPKPeriodeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    # FUNGSI INDEX

    public function index()
    {
        $app    = SistemApp::sistem();
        return view('spk_periode.index', compact('app'));
    }

    # FUNGSI VIEW

    public function view()
    {
        $result = array('success' => false);

        try {

            $data = ModSPKPeriode::get();

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        $result['success'] = true;
        $result['data'] = $data;

        return response()->json($result);
    }

    # FUNGSI SAVE

    public function save(Request $r)
    {

        $data = DB::connection('mysql')->transaction(function () use ($r) {

            $tmp = new ModSPKPeriode();
            $tmp->periode_nama        = $r->nama;

            $tmp->save();

            return true;
        });

        return response()->json($data);
    }

    # FUNGSI EDIT

    public function edit(Request $r)
    {
        $id = $r->get('id');
        $data = ModSPKPeriode::where('periode_id', $id)->first();
        return response()->json($data);
    }

    # FUNGSI UPDATE

    public function update(Request $r)
    {

        $data = DB::connection('mysql')->transaction(function () use ($r) {

            $id = $r->get('id');
            $tmp = ModSPKPeriode::where('periode_id', $id)->first();
            $tmp->periode_nama        = $r->nama;
            $tmp->save();

            return true;
        });

        return response()->json($data);
    }

    # FUNGSI DELETE

    public function delete(Request $r)
    {

        $data = DB::connection('mysql')->transaction(function () use ($r) {

            $id = $r->get('id');
            $tmp = ModSPKPeriode::where('periode_id', $id)->delete();

            return true;
        });

        return response()->json($data);
    }

}
