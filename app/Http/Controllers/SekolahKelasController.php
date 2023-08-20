<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SistemApp;
use App\Models\ModSekolahKelas;
use DB;

class SekolahKelasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    # FUNGSI INDEX

    public function index()
    {
        $app    = SistemApp::sistem();
        return view('sekolah_kelas.index', compact('app'));
    }

    # FUNGSI VIEW

    public function view()
    {
        $result = array('success' => false);

        try {

            $data = DB::connection('mysql')
                            ->table('sekolah_tb_kelas AS aa')
                            ->leftjoin('sekolah_ta_tahun AS bb','bb.tahun_id','aa.tahun_id')
                            ->orderby('aa.tahun_id','desc')
                            ->get();

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

            $tmp = new ModSekolahKelas();
            $tmp->tahun_id          = $r->tahun;
            $tmp->kelas_nama        = $r->nama;

            $tmp->save();

            return true;
        });

        return response()->json($data);
    }

    # FUNGSI EDIT

    public function edit(Request $r)
    {
        $id = $r->get('id');
        $data = ModSekolahKelas::where('kelas_id', $id)->first();
        return response()->json($data);
    }

    # FUNGSI UPDATE

    public function update(Request $r)
    {

        $data = DB::connection('mysql')->transaction(function () use ($r) {

            $id = $r->get('id');
            $tmp = ModSekolahKelas::where('kelas_id', $id)->first();
            $tmp->tahun_id          = $r->tahun;
            $tmp->kelas_nama        = $r->nama;

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
            $tmp = ModSekolahKelas::where('kelas_id', $id)->delete();

            return true;
        });

        return response()->json($data);
    }

}
