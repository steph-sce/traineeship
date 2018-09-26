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
        view()->composer(['partials.menu'], function($view) {
            $searchbar = true;
            $types = true;

            //setting the active nav link
            switch(request()->route()->uri) {
                default :
                    $active = null;
                    break;
                case "/":
                    $active = "index";
                    $searchbar = false;
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
            // Getting rid of stages & formations nav buttons when authenticated
            if (Auth::check() === true) $types = false;

            //
            if(Route::is('show')) $searchbar = false;

            // Setting the active link to dashboard when authenticated user in viewing it
            if(Route::is('post.index')) $active = "dashboard";

           $view->with(['types' => $types, 'active' => $active, 'searchbar' => $searchbar]);
        });


        view()->composer(['front.partials.postCard'], function($view) {
            $details = false;

            if(Route::is(['show'])) $details = true;
            $view->with([ 'details' => $details]);
        });


        view()->composer(['front.show'], function($view) {
            $backlink = null;
            if(Route::is('show'))  $backlink = strtolower(request()->route()->parameters["post"]->post_type) . "s";
            if (Auth::check()) $backlink = 'post.index';
            $view->with(['backlink' => $backlink]);
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
