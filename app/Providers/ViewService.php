<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Route;

class ViewService extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['layouts.master'], function($view){
            $sidebar = true;
            if(Route::is(['show', 'post.*', 'contact'])) $sidebar = false;

            $view->with('sidebar', $sidebar);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
