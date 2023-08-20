<?php

namespace App\Http\Controllers;

use App\Models\SistemApp;

use Illuminate\Http\Request;
use App\Models\ModSPKPeriode;
use App\Models\ModSekolahKelas;
use App\Models\ModSekolahSiswa;
use App\Models\ModSekolahTahun;
use App\Models\ModSekolahDaftar;
Use DB;

class SistemComboController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function peserta()
    {

        $app            = SistemApp::sistem();
        $filter_tahun   =  $app['tahun']; 

        $data = DB::connection('mysql')
                        ->table('sekolah_tc_peserta AS aa')
                        ->leftjoin('sekolah_tb_kelas AS bb','bb.kelas_id','aa.kelas_id')
                        ->leftjoin('sekolah_ta_siswa AS cc','cc.siswa_id','aa.siswa_id')
                        ->where('bb.tahun_id',$filter_tahun)
                        ->orderby('cc.siswa_nama')
                        ->get();             

        return response()->json($data); 
    }

    public function kriteria()
    {

        $data = DB::connection('mysql')
                        ->table('spk_tb_kriteria AS aa')
                        ->leftjoin('spk_ta_periode AS bb','bb.periode_id','aa.periode_id')
                        ->where('bb.periode_aktif','Y')
                        ->orderby('aa.kriteria_urut')
                        ->get();
                        
        return response()->json($data); 
    }

    public function filter_kriteria(Request $r)
    {

        $filter_periode = $r->get('filter_periode');

        $data = DB::connection('mysql')
                        ->table('spk_tb_kriteria AS aa')
                        ->leftjoin('spk_ta_periode AS bb','bb.periode_id','aa.periode_id')
                        ->where('bb.periode_aktif','Y')
                        ->where('aa.periode_id',$filter_periode)
                        ->orderby('aa.kriteria_urut')
                        ->get();
                        
        return response()->json($data); 
    }

    public function filter_periode_kriteria(Request $r)
    {

        $filter_periode = $r->get('filter_periode');

        $data = DB::connection('mysql')
                        ->table('spk_tb_kriteria AS aa')
                        ->leftjoin('spk_ta_periode AS bb','bb.periode_id','aa.periode_id')
                        ->where('bb.periode_aktif','Y')
                        ->where('aa.periode_id',$filter_periode)
                        ->orderby('aa.kriteria_urut')
                        ->get();
                        
        return response()->json($data); 
    }

    public function filter_peserta(Request $r)
    {

        $filter_daftar = $r->get('filter_daftar');

        $data = DB::connection('mysql')
                        ->table('sekolah_tc_peserta AS aa')
                        ->leftjoin('sekolah_ta_tahun_daftar AS bb','bb.daftar_id','aa.daftar_id')
                        ->leftjoin('sekolah_ta_siswa AS cc','cc.siswa_id','aa.siswa_id')
                        // ->where('aa.daftar_aktif','Y')
                        ->where('aa.daftar_id',$filter_daftar)
                        ->get();
                        
        return response()->json($data); 
    }

    public function kuantitatif(Request $r)
    {

        $filter_kriteria = $r->get('filter_kriteria');

        $data = DB::connection('mysql')
                        ->table('spk_tc_kuantitatif AS aa')
                        ->leftjoin('spk_tb_kriteria AS bb','bb.kriteria_id','aa.kriteria_id')
                        ->where('aa.kriteria_id',$filter_kriteria)
                        ->orderby('bb.kriteria_urut')
                        ->get();
                        
        return response()->json($data); 
    }

    
    public function tahun()
    {
       $data = ModSekolahTahun::where('tahun_aktif','Y')->get();
       return response()->json($data);

    }
    
    public function daftar()
    {
       $data = ModSekolahDaftar::where('daftar_aktif','Y')->get();
       return response()->json($data);

    }
    
    public function kelas()
    {
       $data = ModSekolahKelas::where('kelas_aktif','Y')->get();
       return response()->json($data);

    }
    
    public function siswa()
    {
       $data = ModSekolahSiswa::where('siswa_aktif','Y')->get();
       return response()->json($data);
    }
    
    public function periode()
    {
       $data = ModSPKPeriode::where('periode_aktif','Y')->get();
       return response()->json($data);
    }

}
