<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helper\Constants;

class ConstantsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->bind('constants',function(){
            return new Constants();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       
    }
}
