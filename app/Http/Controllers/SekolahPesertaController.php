<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SistemApp;
use App\Models\ModSekolahPeserta;
use DB;

class SekolahPesertaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    # FUNGSI INDEX

    public function index()
    {
        $app    = SistemApp::sistem();
        return view('sekolah_peserta.index', compact('app'));
    }

    # FUNGSI VIEW

    public function view(Request $r)
    {
        $result = array('success' => false);

        try {

            $app            = SistemApp::sistem();
            $filter_tasuk   =  $app['tasuk']; 
            $filter         = $r->filter_tasuk;

            $data = DB::connection('mysql')
                            ->table('sekolah_tc_peserta AS aa')
                            ->select('aa.peserta_id',
                                     'bb.kelas_id',
                                     'bb.kelas_nama',
                                     'cc.siswa_id',
                                     'cc.siswa_nama',
                                     'dd.tahun_id',
                                     'dd.tahun_nama',
                                     'ee.daftar_id',
                                     'ee.daftar_nama')
                            ->leftjoin('sekolah_tb_kelas AS bb','bb.kelas_id','aa.kelas_id')
                            ->leftjoin('sekolah_ta_siswa AS cc','cc.siswa_id','aa.siswa_id')
                            ->leftjoin('sekolah_ta_tahun AS dd','dd.tahun_id','bb.tahun_id')
                            ->leftjoin('sekolah_ta_tahun_daftar AS ee','ee.daftar_id','aa.daftar_id')
                            ->where('aa.daftar_id',$filter)
                            ->get();

            if($filter == 'semua')
            {
                $data = $data->where('peserta_aktif','Y')->flatten();
            } else {
                $data = $data->where('daftar_id',$filter)->flatten();
            }

            // $data = $data->where('daftar_id',$filter)->flatten();
            
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

            $tmp = new ModSekolahPeserta();
            $tmp->kelas_id          = $r->kelas;
            $tmp->siswa_id          = $r->siswa;
            $tmp->daftar_id          = $r->daftar;

            $tmp->save();

            return true;
        });

        return response()->json($data);
    }

    public function edit(Request $r)
    {
        $id = $r->get('id');
        $data = ModSekolahPeserta::where('peserta_id', $id)->first();
        return response()->json($data);
    }

    # FUNGSI UPDATE

    public function update(Request $r)
    {

        $data = DB::connection('mysql')->transaction(function () use ($r) {

            $id = $r->get('id');
            $tmp = ModSekolahPeserta::where('peserta_id', $id)->first();
            $tmp->kelas_id        = $r->kelas;
            $tmp->siswa_id        = $r->siswa;

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
            $tmp = ModSekolahPeserta::where('peserta_id', $id)->delete();

            return true;
        });

        return response()->json($data);
    }

}
