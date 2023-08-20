<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SistemApp;
use App\Models\ModSekolahTahun;
use DB;

class SekolahTahunController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    # FUNGSI INDEX

    public function index()
    {
        $app    = SistemApp::sistem();
        return view('sekolah_tahun.index', compact('app'));
    }

    # FUNGSI VIEW

    public function view()
    {

        $result = array('success' => false);

        try {

            $data = ModSekolahTahun::get();

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
        $kode  = $r->kode;
        $tahun  = $r->nama;
        $count = DB::connection('mysql')
                        ->table('sekolah_ta_tahun')
                        ->where('tahun_kode',$kode)
                        // ->where('tahun_nama',$tahun)
                        ->count();

        if($count > 0) {

            $data = false;

        } else {

            $data = DB::connection('mysql')->transaction(function () use ($r) {

                $tmp = new ModSekolahTahun();
                $tmp->tahun_kode        = $r->kode;
                $tmp->tahun_nama        = $r->nama;
    
                $tmp->save();
    
                return true;
            });

        }

        return response()->json($data);
    }

    # FUNGSI EDIT

    public function edit(Request $r)
    {
        $id = $r->get('id');
        $data = ModSekolahTahun::where('tahun_id', $id)->first();
        return response()->json($data);
    }

    # FUNGSI UPDATE

    public function update(Request $r)
    {

        $data = DB::connection('mysql')->transaction(function () use ($r) {

            $id = $r->get('id');
            $tmp = ModSekolahTahun::where('tahun_id', $id)->first();
            $tmp->tahun_nama    = $r->nama;
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
            $tmp = ModSekolahTahun::where('tahun_id', $id)->delete();

            return true;
        });

        return response()->json($data);
    }

}
