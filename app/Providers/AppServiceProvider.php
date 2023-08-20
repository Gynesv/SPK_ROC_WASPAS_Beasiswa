<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        require_once app_path('Helpers.php');
    }


    public function boot()
    {
        Schema::defaultStringLength(191);
        Schema::defaultStringLength(150);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
    }
}
