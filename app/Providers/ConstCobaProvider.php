<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helper\Constcoba;

class ConstCobaProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('constcoba', function(){
            return new Constcoba();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
