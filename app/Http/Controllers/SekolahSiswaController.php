<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SistemApp;
use App\Models\ModSekolahSiswa;
use DB;

class SekolahSiswaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    # FUNGSI INDEX

    public function index()
    {
        $app    = SistemApp::sistem();
        return view('sekolah_siswa.index', compact('app'));
    }

    # FUNGSI VIEW

    public function view(Request $r)
    {
        $result = array('success' => false);

        try {

            $app            = SistemApp::sistem();
            $filter_tahun   =  $app['tahun']; 
            $filter         = $r->filter_tahun;

            $data = DB::connection('mysql')
                            ->table('sekolah_ta_siswa AS aa')
                            ->select('aa.siswa_id',
                                     'aa.siswa_nisn',
                                     'aa.siswa_nama',
                                     'aa.siswa_jekel',
                                     'aa.siswa_alamat',
                                     'bb.tahun_id',
                                     'bb.tahun_nama')
                            ->leftjoin('sekolah_ta_tahun AS bb','bb.tahun_id','aa.tahun_id')
                            ->where('aa.tahun_id',$filter)
                            ->orderby('aa.tahun_id','desc')
                            ->orderby('aa.siswa_nama')
                            ->get();

            $data = $data->map(function ($value) use($data) {

                $value->siswa_jekel       = format_jekel($value->siswa_jekel);

                return $value;
            });

            if($filter == 'semua')
            {
                $data = $data->where('siswa_aktif','Y')->flatten();
            } else {
                $data = $data->where('tahun_id',$filter)->flatten();
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

            $tmp = new ModSekolahSiswa();
            $tmp->tahun_id          = $r->tahun;
            $tmp->siswa_nisn        = $r->nisn;
            $tmp->siswa_nama        = $r->nama;
            $tmp->siswa_jekel       = $r->jekel;
            $tmp->siswa_alamat      = $r->alamat;

            $tmp->save();

            return true;
        });

        return response()->json($data);
    }

    # FUNGSI EDIT

    public function edit(Request $r)
    {
        $id = $r->get('id');
        $data = ModSekolahSiswa::where('siswa_id', $id)->first();
        return response()->json($data);
    }

    # FUNGSI UPDATE

    public function update(Request $r)
    {

        $data = DB::connection('mysql')->transaction(function () use ($r) {

            $id = $r->get('id');
            $tmp = ModSekolahSiswa::where('siswa_id', $id)->first();
            $tmp->tahun_id          = $r->tahun;
            $tmp->siswa_nisn        = $r->nisn;
            $tmp->siswa_nama        = $r->nama;
            $tmp->siswa_jekel       = $r->jekel;
            $tmp->siswa_alamat      = $r->alamat;
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
            $tmp = ModSekolahSiswa::where('siswa_id', $id)->delete();

            return true;
        });

        return response()->json($data);
    }

}
