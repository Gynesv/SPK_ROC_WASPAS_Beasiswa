<?php

namespace App\Http\Controllers;

use DB;

use App\Models\SistemApp;
use Illuminate\Http\Request;
use App\Models\ModSPKKuantitatif;
use App\Models\ModSPKPeriode;

class SPKKuantitatifController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    # FUNGSI INDEX

    public function index()
    {
        $app    = SistemApp::sistem();
        return view('spk_kuantitatif.index', compact('app'));
    }

    # FUNGSI VIEW

    public function view(Request $r)
    {
        $result = array('success' => false);

        try {

            $app = SistemApp::sistem();
            $filter_periode = $app['periode'];
            $filter    = $r->filter_periode;

            $data = DB::connection('mysql')
                            ->table('spk_tc_kuantitatif AS aa')
                            ->select('aa.kua_id',
                                     'aa.nilai_ket',
                                     'aa.nilai_bobot',
                                     'bb.kriteria_id',
                                     'bb.kriteria_nama',
                                     'cc.periode_id',
                                     'cc.periode_nama')
                            ->leftjoin('spk_tb_kriteria AS bb','bb.kriteria_id','aa.kriteria_id')
                            ->leftjoin('spk_ta_periode AS cc','cc.periode_id','bb.periode_id')
                            ->where('cc.periode_id',$filter)
                            ->orderby('bb.kriteria_urut')
                            ->orderby('aa.nilai_bobot')
                            ->get();


            if($filter == 'semua')
            {
                $data = $data->where('nilai_aktif','Y')->flatten();
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

        $data = DB::connection('mysql')->transaction(function () use ($r) {

            $tmp = new ModSPKKuantitatif();
            $tmp->kriteria_id   = $r->kriteria;
            $tmp->nilai_ket     = $r->keterangan;
            $tmp->nilai_bobot   = $r->nilai;

            $tmp->save();

            return true;
        });

        return response()->json($data);
    }

    # FUNGSI EDIT

    public function edit(Request $r)
    {
        $id = $r->get('id');
        $data = ModSPKKuantitatif::where('kua_id', $id)->first();
        return response()->json($data);
    }

    # FUNGSI UPDATE

    public function update(Request $r)
    {

        $data = DB::connection('mysql')->transaction(function () use ($r) {

            $id = $r->get('id');
            $tmp = ModSPKKuantitatif::where('kua_id', $id)->first();
            $tmp->kriteria_id   = $r->kriteria;
            $tmp->nilai_ket     = $r->keterangan;
            $tmp->nilai_bobot   = $r->nilai;
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
            $tmp = ModSPKKuantitatif::where('kua_id', $id)->delete();

            return true;
        });

        return response()->json($data);
    }

}
