<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Route;
use Illuminate\Support\Facades\Request;
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
            if(Route::is(['show', 'post.*', 'contact', 'showTrash'])) $sidebar = false;

            $view->with('sidebar', $sidebar);
        });

        view()->composer(['partials.menu'], function($view) {
            switch(request()->route()->uri) {
                default :
                    $active = null;
                    break;
                case "/":
                    $active = "index";
                    break;
                case "contact":
                    $active = "contact";
                    break;
                case "stages" :
                    $active = "stages";
                    break;
                case "formations":
                    $active = "formations";
                    break;
            }
            $types = true;
            if (Auth::check() === true) $types = false;
            if(Route::is('post.index')) $active = "dashboard";
           $view->with(['types' => $types, 'active' => $active]);
        });


        view()->composer(['front.partials.postCard'], function($view) {
            $details = false;
            if(Route::is(['show'])) $details = true;
            $view->with('details', $details);
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
