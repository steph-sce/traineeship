<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Route;
use Illuminate\Support\Facades\Auth;

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

        view()->composer(['partials.menu'], function($view) {
            $types = true;
            if (Auth::check() === true) $types = false;
           $view->with('types', $types);
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
