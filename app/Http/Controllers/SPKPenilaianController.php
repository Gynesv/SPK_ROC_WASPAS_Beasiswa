<?php

namespace App\Http\Controllers;

use DB;

use PDF;
use App\Helpers;
use App\Models\SistemApp;
use Illuminate\Http\Request;
use App\Models\ModSPKKriteria;
use App\Exports\KaryawanExport;

use App\Models\ModSPKPenilaian;
use App\Exports\PenilaianExport;
use App\Models\ModSPKKuantitatif;
use Maatwebsite\Excel\Facades\Excel;

class SPKPenilaianController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    # FUNGSI INDEX

    public function index()
    {
        $app    = SistemApp::sistem();
        return view('spk_penilaian.index', compact('app'));
    }

    # FUNGSI VIEW

    public function view(Request $r)
    {
        $result = array('success' => false);

        try {

            $app                = SistemApp::sistem();
            $filter_tahun       =  $app['tahun']; 
            $filter_tasuk       =  $app['tasuk']; 
            $filter_periode     =  $app['periode']; 
            $filter             = $r->filter_periode;
            $filter_daftar      = $r->filter_daftar;

            /*== KRITERIA ==*/

            $kriteria_sumber = DB::connection('mysql')
                                        ->table('spk_tb_kriteria AS aa')
                                        ->leftjoin('spk_ta_periode AS bb','bb.periode_id','aa.periode_id')
                                        ->where('aa.periode_id',$filter)
                                        ->orderby('aa.kriteria_urut')
                                        ->get();

            $kriteria_count = $kriteria_sumber->count();

            $kriteria_sumber = $kriteria_sumber->map(function ($value) use($kriteria_count) {

                $value->kriteria_tipe       = format_tipe($value->kriteria_tipe);

                $urut = $value->kriteria_urut;

                $bobot = 0;
                for($i = $urut; $i<=$kriteria_count ;$i++)
                {
                   
                    $bobot = $bobot + 1/$i;
                }

                $value->kriteria_bobot   = round(($bobot/$kriteria_count),2);

                return $value;
            });


            /*== KUANTITATIF ==*/

            $data = DB::connection('mysql')
                            ->table('spk_td_penilaian AS aa')
                            ->leftjoin('spk_tc_kuantitatif AS bb','bb.kua_id','aa.kua_id')
                            ->leftjoin('spk_tb_kriteria AS cc','cc.kriteria_id','bb.kriteria_id')
                            ->leftjoin('sekolah_tc_peserta AS dd','dd.peserta_id','aa.peserta_id')
                            ->leftjoin('sekolah_tb_kelas AS ee','ee.kelas_id','dd.kelas_id')
                            ->leftjoin('sekolah_ta_siswa AS ff','ff.siswa_id','dd.siswa_id')
                            ->leftjoin('sekolah_ta_tahun_daftar AS gg', 'gg.daftar_id','dd.daftar_id')
                            ->leftjoin('spk_ta_periode AS hh', 'hh.periode_id','cc.periode_id')
                            ->where('ee.tahun_id',$filter_tahun)
                            ->where('gg.daftar_id',$filter_daftar)
                            ->where('hh.periode_id',$filter)
                            ->orderby('ff.siswa_nisn')
                            ->orderby('cc.kriteria_urut')
                            ->get();


            $sumber = $data;


            $data = $data->map(function ($value) use($sumber,$kriteria_sumber) {


                $kriteria_id    = $value->kriteria_id;
                $kriteria_tipe  = $value->kriteria_tipe;

                if ($kriteria_tipe == 'B') {

                    /* == MAX == */

                    $nilai_maxmin                   = $sumber->where('kriteria_id',$kriteria_id)->max('nilai_bobot');
                    $value->nilai_normalisasi       = round(($value->nilai_bobot/$nilai_maxmin),2);

                } else if ($kriteria_tipe == 'C') {

                    /* == MIN == */

                    $nilai_maxmin                   = $sumber->where('kriteria_id',$kriteria_id)->min('nilai_bobot');
                    $value->nilai_normalisasi       = round(($nilai_maxmin/$value->nilai_bobot),2);

                }

                $value->nilai_maxmin    = $nilai_maxmin;


                /* == SIGMA KALI == */

                $kriteria = $kriteria_sumber->where('kriteria_id',$kriteria_id)->first(); 

                if ($kriteria_id == $kriteria->kriteria_id ) {
                    $value->nilai_sigma_kali        =   round(($value->nilai_normalisasi * $kriteria->kriteria_bobot),2);
                    $value->nilai_sigma_pangkat     =   round((pow($value->nilai_normalisasi,$kriteria->kriteria_bobot)),2);
                }

                return $value;
            });

            // DATA SIGMA

            $peserta_sigma = DB::connection('mysql')
                        ->table('spk_td_penilaian AS aa')
                        ->select('aa.peserta_id',
                                 'ff.siswa_nisn',
                                 'ff.siswa_nama',
                                 'ee.kelas_nama')
                        ->leftjoin('spk_tc_kuantitatif AS bb','bb.kua_id','aa.kua_id')
                        ->leftjoin('spk_tb_kriteria AS cc','cc.kriteria_id','bb.kriteria_id')
                        ->leftjoin('sekolah_tc_peserta AS dd','dd.peserta_id','aa.peserta_id')
                        ->leftjoin('sekolah_tb_kelas AS ee','ee.kelas_id','dd.kelas_id')
                        ->leftjoin('sekolah_ta_siswa AS ff','ff.siswa_id','dd.siswa_id')
                        ->leftjoin('spk_ta_periode AS gg','gg.periode_id','cc.periode_id')
                        ->leftjoin('sekolah_ta_tahun_daftar AS hh', 'hh.daftar_id','dd.daftar_id')
                        ->where('gg.periode_id',$filter)
                        ->where('ee.tahun_id',$filter_tahun)
                        ->where('hh.daftar_id',$filter_daftar)
                        ->groupby('aa.peserta_id')
                        ->get();

            $peserta = $peserta_sigma->groupby('peserta_id')->flatten();

            $sigma_pangkat = $peserta_sigma->count();

            $data_sigma = $peserta->map(function ($value) use($data) {

                // NILAI SIGMA KALI 
                
                $value->sigma_kali_jumlah           = round(($data->where('peserta_id',$value->peserta_id)->sum('nilai_sigma_kali')),2);
                $value->sigma_nilai_kali_jumlah     = round(($value->sigma_kali_jumlah * 0.5),2);


                // NILAI SIGMA PANGKAT 

                $datax = $data->where('peserta_id',$value->peserta_id);

                $nilai_pangkat=1;
                foreach ($datax as $r) {
                    $nilai_pangkat = $nilai_pangkat * $r->nilai_sigma_pangkat;
                }

                $value->sigma_kali_pangkat          = round(($nilai_pangkat),2);
                $value->sigma_nilai_kali_pangkat    = round(($value->sigma_kali_pangkat * 0.5),2);




                // NILAI QI

                $value->nilai_qi                    = round(($value->sigma_nilai_kali_jumlah + $value->sigma_nilai_kali_pangkat),2);

                return $value;
            })->sortBydesc('nilai_qi')->flatten();

            // if($filter = 'semua')
            // {
            //     $data = $data->where('periode_aktif','Y')->flatten();
            //     // $data_sigma = $data_sigma->where('periode_aktif','Y')->flatten();
            // } else {
            //     // $data = $data->where('periode_id',$filter)->flatten();
            //     $data_sigma = $data_sigma->where('periode_id',$filter)->flatten();
            // }

            if($filter_daftar = 'semua'){
                if($filter = 'semua'){
                    $data = $data->where('daftar_aktif','Y')->flatten();
                } else {
                    $data = $data->where('periode_aktif','Y')->flatten();
                }
            } else {
                if($filter_daftar = $r->filter_daftar){
                    $data_sigma = $data_sigma->where('daftar_id',$filter_daftar)->flatten();
                } else {
                    $data_sigma = $data_sigma->where('periode_id',$filter)->flatten();
                }
            }
            

        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
            return response()->json($result);
        }

        $result['success'] = true;
        $result['data'] = $data;
        $result['data_sigma'] = $data_sigma;

        return response()->json($result);
    }

    # FUNGSI SAVE

    public function save(Request $r)
    {


        $filter_peserta        = $r->filter_peserta;
        $periode               = $r->periode;
        $kuantittatif          = ModSPKKuantitatif::where('kua_id',$r->kuantitatif)->first();
        $kriteria              = $kuantittatif->kriteria_id;

        $count = DB::connection('mysql')
                        ->table('spk_td_penilaian AS aa')
                        ->leftjoin('spk_tc_kuantitatif AS bb','bb.kua_id','aa.kua_id')
                        ->leftjoin('spk_tb_kriteria AS cc','cc.kriteria_id','bb.kriteria_id')
                        ->where('aa.peserta_id',$filter_peserta)
                        ->where('cc.kriteria_id',$kriteria)
                        ->count();


        if ($count > 0) {

            $data = false;

        } else {

            $data = DB::connection('mysql')->transaction(function () use ($r) {

                $tmp = new ModSPKPenilaian();
                $tmp->peserta_id    = $r->filter_peserta;
                $tmp->kua_id        = $r->kuantitatif;
    
                $tmp->save();
    
                return true;
            });

        }

        return response()->json($data);
    }

    # FUNGSI DELETE

    public function delete(Request $r)
    {

        $data = DB::connection('mysql')->transaction(function () use ($r) {

            $id = $r->get('id');
            $tmp = ModSPKPenilaian::where('penilaian_id', $id)->delete();

            return true;
        });

        return response()->json($data);
    }
    

    # CETAK PDF

    public function cetak_pdf(Request $r){

        // composer require barryvdh/laravel-dompdf

        $app                = SistemApp::sistem();
        $filter_tahun       =  $app['tahun']; 
        $filter_periode     =  $app['periode']; 
        $filter             = $r->periode_id;

                    /*== KRITERIA ==*/

            $kriteria_sumber = DB::connection('mysql')
                                        ->table('spk_tb_kriteria AS aa')
                                        ->leftjoin('spk_ta_periode AS bb','bb.periode_id','aa.periode_id')
                                        ->where('aa.periode_id',$filter_periode)
                                        ->orderby('aa.kriteria_urut')
                                        ->get();

            $kriteria_count = $kriteria_sumber->count();

            $kriteria_sumber = $kriteria_sumber->map(function ($value) use($kriteria_count) {

                $value->kriteria_tipe       = format_tipe($value->kriteria_tipe);

                $urut = $value->kriteria_urut;

                $bobot = 0;
                for($i = $urut; $i<=$kriteria_count ;$i++)
                {
                   
                    $bobot = $bobot + 1/$i;
                }

                $value->kriteria_bobot   = round(($bobot/$kriteria_count),2);

                return $value;
            });


            /*== KUANTITATIF ==*/

            $data = DB::connection('mysql')
                            ->table('spk_td_penilaian AS aa')
                            ->leftjoin('spk_tc_kuantitatif AS bb','bb.kua_id','aa.kua_id')
                            ->leftjoin('spk_tb_kriteria AS cc','cc.kriteria_id','bb.kriteria_id')
                            ->leftjoin('sekolah_tc_peserta AS dd','dd.peserta_id','aa.peserta_id')
                            ->leftjoin('sekolah_tb_kelas AS ee','ee.kelas_id','dd.kelas_id')
                            ->leftjoin('sekolah_ta_siswa AS ff','ff.siswa_id','dd.siswa_id')
                            ->leftjoin('spk_ta_periode AS gg','gg.periode_id','cc.periode_id')
                            ->where('ee.tahun_id',$filter_tahun)
                            ->where('gg.periode_id',$filter_periode)
                            ->orderby('ff.siswa_nisn')
                            ->orderby('cc.kriteria_urut')
                            ->get();


            $sumber = $data;


            $data = $data->map(function ($value) use($sumber,$kriteria_sumber) {


                $kriteria_id    = $value->kriteria_id;
                $kriteria_tipe  = $value->kriteria_tipe;

                if ($kriteria_tipe == 'B') {

                    /* == MAX == */

                    $nilai_maxmin                   = $sumber->where('kriteria_id',$kriteria_id)->max('nilai_bobot');
                    $value->nilai_normalisasi       = round(($value->nilai_bobot/$nilai_maxmin),2);

                } else if ($kriteria_tipe == 'C') {

                    /* == MIN == */

                    $nilai_maxmin                   = $sumber->where('kriteria_id',$kriteria_id)->min('nilai_bobot');
                    $value->nilai_normalisasi       = round(($nilai_maxmin/$value->nilai_bobot),2);

                }

                $value->nilai_maxmin    = $nilai_maxmin;


                /* == SIGMA KALI == */

                $kriteria = $kriteria_sumber->where('kriteria_id',$kriteria_id)->first(); 

                if ($kriteria_id == $kriteria->kriteria_id ) {
                    $value->nilai_sigma_kali        =   round(($value->nilai_normalisasi * $kriteria->kriteria_bobot),2);
                    $value->nilai_sigma_pangkat     =   round((pow($value->nilai_normalisasi,$kriteria->kriteria_bobot)),2);
                }

                return $value;
            });


            // DATA SIGMA

            $peserta_sigma = DB::connection('mysql')
                        ->table('spk_td_penilaian AS aa')
                        ->select('aa.peserta_id',
                                 'ff.siswa_nisn',
                                 'ff.siswa_nama',
                                 'ee.kelas_nama')
                        ->leftjoin('spk_tc_kuantitatif AS bb','bb.kua_id','aa.kua_id')
                        ->leftjoin('spk_tb_kriteria AS cc','cc.kriteria_id','bb.kriteria_id')
                        ->leftjoin('sekolah_tc_peserta AS dd','dd.peserta_id','aa.peserta_id')
                        ->leftjoin('sekolah_tb_kelas AS ee','ee.kelas_id','dd.kelas_id')
                        ->leftjoin('sekolah_ta_siswa AS ff','ff.siswa_id','dd.siswa_id')
                        ->leftjoin('spk_ta_periode AS gg','gg.periode_id','cc.periode_id')
                        ->where('ee.tahun_id',$filter_tahun)
                        ->where('gg.periode_id',$filter_periode)
                        ->groupby('aa.peserta_id')
                        ->get();

            $peserta = $peserta_sigma->groupby('peserta_id')->flatten();

            $sigma_pangkat = $peserta_sigma->count();

            $data_sigma = $peserta->map(function ($value) use($data) {
                

                $value->sigma_kali_jumlah           = round(($data->where('peserta_id',$value->peserta_id)->sum('nilai_sigma_kali')),2);


                $value->sigma_kali_pangkat          = round(($data->where('peserta_id',$value->peserta_id)->sum('nilai_sigma_pangkat')),2);

                $value->sigma_nilai_kali_jumlah     = round(($value->sigma_kali_jumlah * 0.5),2);

                $value->sigma_nilai_kali_pangkat    = round(($value->sigma_kali_pangkat * 0.5),2);

                $value->nilai_qi                    = round(($value->sigma_nilai_kali_jumlah + $value->sigma_nilai_kali_pangkat),2);

                return $value;
                
            })->sortBydesc('nilai_qi')->flatten();



        $pdf = PDF::loadview('spk_penilaian.cetak_data',compact('data','data_sigma'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Struk.pdf');
        // return $pdf->download('Struk.pdf');

    }

    // public function cetak_pdf(Request $r)
    // {
    //     $result = array('success' => false);

    //     // try {

    //         $app                = SistemApp::sistem();
    //         $filter_tahun       =  $app['tahun']; 
    //         $filter_tasuk       =  $app['tasuk']; 
    //         $filter_periode     =  $app['periode']; 
    //         $filter             = $r->filter_periode;
    //         $filter_daftar      = $r->filter_daftar;

    //         /*== KRITERIA ==*/

    //         $kriteria_sumber = DB::connection('mysql')
    //                                     ->table('spk_tb_kriteria AS aa')
    //                                     ->leftjoin('spk_ta_periode AS bb','bb.periode_id','aa.periode_id')
    //                                     ->where('aa.periode_id',$filter_periode)
    //                                     ->orderby('aa.kriteria_urut')
    //                                     ->get();

    //         $kriteria_count = $kriteria_sumber->count();

    //         $kriteria_sumber = $kriteria_sumber->map(function ($value) use($kriteria_count) {

    //             $value->kriteria_tipe       = format_tipe($value->kriteria_tipe);

    //             $urut = $value->kriteria_urut;

    //             $bobot = 0;
    //             for($i = $urut; $i<=$kriteria_count ;$i++)
    //             {
                   
    //                 $bobot = $bobot + 1/$i;
    //             }

    //             $value->kriteria_bobot   = round(($bobot/$kriteria_count),2);

    //             return $value;
    //         });


    //         /*== KUANTITATIF ==*/

    //         $data = DB::connection('mysql')
    //                         ->table('spk_td_penilaian AS aa')
    //                         ->leftjoin('spk_tc_kuantitatif AS bb','bb.kua_id','aa.kua_id')
    //                         ->leftjoin('spk_tb_kriteria AS cc','cc.kriteria_id','bb.kriteria_id')
    //                         ->leftjoin('sekolah_tc_peserta AS dd','dd.peserta_id','aa.peserta_id')
    //                         ->leftjoin('sekolah_tb_kelas AS ee','ee.kelas_id','dd.kelas_id')
    //                         ->leftjoin('sekolah_ta_siswa AS ff','ff.siswa_id','dd.siswa_id')
    //                         ->leftjoin('sekolah_ta_tahun_daftar AS gg', 'gg.daftar_id','dd.daftar_id')
    //                         ->leftjoin('spk_ta_periode AS hh', 'hh.periode_id','cc.periode_id')
    //                         ->where('ee.tahun_id',$filter_tahun)
    //                         // ->where('gg.daftar_id',$filter_daftar)
    //                         ->where('hh.periode_id',$filter_periode)
    //                         ->orderby('ff.siswa_nisn')
    //                         ->orderby('cc.kriteria_urut')
    //                         ->get();


    //         $sumber = $data;


    //         $data = $data->map(function ($value) use($sumber,$kriteria_sumber) {


    //             $kriteria_id    = $value->kriteria_id;
    //             $kriteria_tipe  = $value->kriteria_tipe;

    //             if ($kriteria_tipe == 'B') {

    //                 /* == MAX == */

    //                 $nilai_maxmin                   = $sumber->where('kriteria_id',$kriteria_id)->max('nilai_bobot');
    //                 $value->nilai_normalisasi       = round(($value->nilai_bobot/$nilai_maxmin),2);

    //             } else if ($kriteria_tipe == 'C') {

    //                 /* == MIN == */

    //                 $nilai_maxmin                   = $sumber->where('kriteria_id',$kriteria_id)->min('nilai_bobot');
    //                 $value->nilai_normalisasi       = round(($nilai_maxmin/$value->nilai_bobot),2);

    //             }

    //             $value->nilai_maxmin    = $nilai_maxmin;


    //             /* == SIGMA KALI == */

    //             $kriteria = $kriteria_sumber->where('kriteria_id',$kriteria_id)->first(); 

    //             if ($kriteria_id == $kriteria->kriteria_id ) {
    //                 $value->nilai_sigma_kali        =   round(($value->nilai_normalisasi * $kriteria->kriteria_bobot),2);
    //                 $value->nilai_sigma_pangkat     =   round((pow($value->nilai_normalisasi,$kriteria->kriteria_bobot)),2);
    //             }

    //             return $value;
    //         });

    //         // DATA SIGMA

    //         $peserta_sigma = DB::connection('mysql')
    //                     ->table('spk_td_penilaian AS aa')
    //                     ->select('aa.peserta_id',
    //                              'ff.siswa_nisn',
    //                              'ff.siswa_nama',
    //                              'ee.kelas_nama')
    //                     ->leftjoin('spk_tc_kuantitatif AS bb','bb.kua_id','aa.kua_id')
    //                     ->leftjoin('spk_tb_kriteria AS cc','cc.kriteria_id','bb.kriteria_id')
    //                     ->leftjoin('sekolah_tc_peserta AS dd','dd.peserta_id','aa.peserta_id')
    //                     ->leftjoin('sekolah_tb_kelas AS ee','ee.kelas_id','dd.kelas_id')
    //                     ->leftjoin('sekolah_ta_siswa AS ff','ff.siswa_id','dd.siswa_id')
    //                     ->leftjoin('spk_ta_periode AS gg','gg.periode_id','cc.periode_id')
    //                     ->leftjoin('sekolah_ta_tahun_daftar AS hh', 'hh.daftar_id','dd.daftar_id')
    //                     ->where('gg.periode_id',$filter_periode)
    //                     ->where('ee.tahun_id',$filter_tahun)
    //                     ->where('hh.daftar_id',$filter_daftar)
    //                     ->groupby('aa.peserta_id')
    //                     ->get();

    //         $peserta = $peserta_sigma->groupby('peserta_id')->flatten();

    //         $sigma_pangkat = $peserta_sigma->count();

    //         $data_sigma = $peserta->map(function ($value) use($data) {

    //             // NILAI SIGMA KALI 
                
    //             $value->sigma_kali_jumlah           = round(($data->where('peserta_id',$value->peserta_id)->sum('nilai_sigma_kali')),2);
    //             $value->sigma_nilai_kali_jumlah     = round(($value->sigma_kali_jumlah * 0.5),2);


    //             // NILAI SIGMA PANGKAT 

    //             $datax = $data->where('peserta_id',$value->peserta_id);

    //             $nilai_pangkat=1;
    //             foreach ($datax as $r) {
    //                 $nilai_pangkat = $nilai_pangkat * $r->nilai_sigma_pangkat;
    //             }

    //             $value->sigma_kali_pangkat          = round(($nilai_pangkat),2);
    //             $value->sigma_nilai_kali_pangkat    = round(($value->sigma_kali_pangkat * 0.5),2);




    //             // NILAI QI

    //             $value->nilai_qi                    = round(($value->sigma_nilai_kali_jumlah + $value->sigma_nilai_kali_pangkat),2);

    //             return $value;
    //         })->sortBydesc('nilai_qi')->flatten();

    //         // if($filter = 'semua')
    //         // {
    //         //     $data = $data->where('periode_aktif','Y')->flatten();
    //         //     // $data_sigma = $data_sigma->where('periode_aktif','Y')->flatten();
    //         // } else {
    //         //     // $data = $data->where('periode_id',$filter)->flatten();
    //         //     $data_sigma = $data_sigma->where('periode_id',$filter)->flatten();
    //         // }

    //         if($filter_daftar = 'semua'){
    //             if($filter = 'semua'){
    //                 $data = $data->where('daftar_aktif','Y')->flatten();
    //             } else {
    //                 $data = $data->where('periode_aktif','Y')->flatten();
    //             }
    //         } else {
    //             if($filter_daftar = $r->filter_daftar){
    //                 $data_sigma = $data_sigma->where('daftar_id',$filter_daftar)->flatten();
    //             } else {
    //                 $data_sigma = $data_sigma->where('periode_id',$filter)->flatten();
    //             }
    //         }
            

    //     // } catch (\Exception $e) {
    //     //     $result['message'] = $e->getMessage();
    //     //     return response()->json($result);
    //     // }

    //     // $result['success'] = true;
    //     // $result['data'] = $data;
    //     // $result['data_sigma'] = $data_sigma;

    //     // return response()->json($result);

    //     $pdf = PDF::loadview('spk_penilaian.cetak_data',compact('data_sigma'));
    //     $pdf->setPaper('A4', 'landscape');
    //     return $pdf->stream('Struk.pdf');
    //     // return $pdf->download('Struk.pdf');
    // }

    public function cetak_excel(Request $r){

        // composer require maatwebsite/excel
        // php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"

        return Excel::download(new PenilaianExport(), 'Hasil Penilaian.xlsx');

    }

}
