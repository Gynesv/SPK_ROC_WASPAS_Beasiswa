<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Http\Request;
use App\Models\SistemApp;

use App\Helpers;
use Carbon\Carbon;
use StdClass;

use App\Models\ModSPKPenilaian;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PenilaianExport implements FromView
{

    public function view(): View
    {
        $app                = SistemApp::sistem();
        $filter_tahun       =  $app['tahun']; 
        $filter_periode     =  $app['periode']; 

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
                            ->where('ee.tahun_id',$filter_tahun)
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
                        ->where('ee.tahun_id',$filter_tahun)
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

            return view('spk_penilaian.cetak_excel', ['data_sigma' => $data_sigma]);
    }
}
