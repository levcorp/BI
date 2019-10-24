<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Jenssegers\Date\Date;
class AppServiceProvider extends ServiceProvider
{
    public function register()
    {

    }
    public function boot()
    {
        Date::setLocale('es');
        Schema::defaultStringLength(191);
        Carbon::setLocale(config('app.locale'));
        putenv("LDAPTLS_CIPHER_SUITE=NORMAL:!VERS-TLS1.2");
        putenv("TLS_CACERT=/path/to/certificate");
        putenv("TLS_REQCERT=never");
    }
}
