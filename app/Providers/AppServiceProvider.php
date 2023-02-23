<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon; //para traducir fechas al español :JB

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale')); //para traducir fechas al español :JB
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Agregado segun guia styd para deploy en server compartido 
        //con carpeta public llamada public_html atte JB 
        $this->app->bind('path.public', function() {
            //return base_path().'\public_html';
            return base_path().'\public';
        });
    }
}
