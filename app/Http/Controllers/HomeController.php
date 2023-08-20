<?php

namespace App\Http\Controllers;

use App\Models\SistemApp;
use App\Models\SistemUsers;
use Illuminate\Http\Request;
use App\Models\ModSekolahSiswa;
use App\Models\ModSekolahPeserta;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $menu   = SistemUsers::get();
        $app    = SistemApp::sistem();
        $filter_tahun   = $app['tahun'];
        $filter_tahun_daftar   = $app['tasuk'];

        $siswa  = ModSekolahSiswa::all()->where('tahun_id',$filter_tahun)->count();
        $peserta = DB::connection('mysql')
                        ->table('sekolah_tc_peserta AS aa')
                        ->leftjoin('sekolah_ta_tahun_daftar AS bb','bb.daftar_id','aa.daftar_id')
                        ->where('aa.daftar_id',$filter_tahun_daftar)
                        ->count();

        return view('home', compact('menu','siswa','peserta'));
    }
}
