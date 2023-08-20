<?php

namespace App\Http\Controllers;

use DB;

use App\Helpers;
use App\Models\SistemApp;

use Illuminate\Http\Request;
use App\Models\ModSPKPeriode;
use App\Models\ModSPKKriteria;

class SPKKriteriaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    # FUNGSI INDEX

    public function index()
    {
        $app    = SistemApp::sistem();
        return view('spk_kriteria.index', compact('app'));
    }

    # FUNGSI VIEW

    public function view(Request $r)
    {
        $result = array('success' => false);

        try {

            $app            = SistemApp::sistem();
            $filter_periode   =  $app['periode']; 
            $filter         = $r->filter_periode;

            $data = DB::connection('mysql')
                            ->table('spk_tb_kriteria AS aa')
                            ->select('aa.kriteria_id',
                                    'aa.kriteria_kode',
                                    'aa.kriteria_nama',
                                    'aa.kriteria_tipe',
                                    'aa.kriteria_urut',
                                    'bb.periode_id',
                                    'bb.periode_nama')
                            ->leftjoin('spk_ta_periode AS bb','bb.periode_id','aa.periode_id')
                            ->where('aa.periode_id',$filter)
                            ->orderby('aa.kriteria_urut')
                            ->get();

            $count = $data->count();

            $data = $data->map(function ($value) use($count) {

                $value->kriteria_tipe       = format_tipe($value->kriteria_tipe);

                $urut = $value->kriteria_urut;

                $bobot = 0;
                for($i = $urut; $i<=$count ;$i++)
                {
                   
                    $bobot = $bobot + 1/$i;
                }

                $value->kriteria_bobot   = number_format(($bobot/$count),2);

                return $value;
            });

            if($filter == 'semua')
            {
                $data = $data->where('kriteria_aktif','Y')->flatten();
            } else {
                $data = $data->where('periode_id',$filter)->flatten();
            }

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

        $kode       = $r->kode;
        $app            = SistemApp::sistem();
        $filter_periode   =  $app['periode']; 

        $periode1    = ModSPKPeriode::where('periode_id',$r->periode)->first();
        $periode2    = $periode1->kriteria_kode;
        $periode    = $r->periode;

        $save   = DB::connection('mysql')
                        ->table('spk_tb_kriteria AS aa')
                        ->leftjoin('spk_ta_periode AS bb','bb.periode_id','aa.periode_id')
                        ->where('aa.kriteria_kode',$kode)
                        ->where('bb.periode_id',$periode)
                        ->count();

        if ($save > 0) {

            $data = false;

        } else {

            $data = DB::connection('mysql')->transaction(function () use ($r) {

                $tmp = new ModSPKKriteria();
                $tmp->periode_id        = $r->periode;
                $tmp->kriteria_urut     = $r->urut;
                $tmp->kriteria_kode     = $r->kode;
                $tmp->kriteria_nama     = $r->nama;
                $tmp->kriteria_tipe     = $r->tipe;
    
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
        $data = ModSPKKriteria::where('kriteria_id', $id)->first();
        return response()->json($data);
    }

    # FUNGSI UPDATE

    public function update(Request $r)
    {

        $data = DB::connection('mysql')->transaction(function () use ($r) {

            $id = $r->get('id');
            $tmp = ModSPKKriteria::where('kriteria_id', $id)->first();
            $tmp->periode_id        = $r->periode;
            $tmp->kriteria_urut     = $r->urut;
            $tmp->kriteria_kode     = $r->kode;
            $tmp->kriteria_nama     = $r->nama;
            $tmp->kriteria_tipe     = $r->tipe;
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
            $tmp = ModSPKKriteria::where('kriteria_id', $id)->delete();

            return true;
        });

        return response()->json($data);
    }

}
