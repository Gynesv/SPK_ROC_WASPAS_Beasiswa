<?php

namespace App\Models;

use DB;
use config;
use Carbon\Carbon;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;

use App\Models\ModSPKPeriode;

use App\Models\ModSekolahTahun;
use App\Models\ModSekolahDaftar;
use Illuminate\Database\Eloquent\Model;

class SistemApp extends Model
{

    public static function sistem() {

        $app = array();

        $user_nama                          = \Auth::guard()->user()->name;
        $user_nama_pecah                    = explode(" ",$user_nama);
        $user_nama_awal                     = $user_nama_pecah[0];

        $app['user_nama']                   = $user_nama_awal;
        $app['user_nama_lengkap']           = $user_nama ;

        $app['url']                         = config('app.url');
        $app['url_dokumen']                 = config('app.url_dokumen');


        $app['tahun']                       = ModSekolahTahun::where('tahun_aktif','Y')->first()->tahun_id;
        $app['periode']                     = ModSPKPeriode::where('periode_aktif','Y')->first()->periode_id;
        $app['tasuk']                       = ModSekolahDaftar::where('daftar_aktif','Y')->first()->daftar_id;


        return $app;
    }

}
