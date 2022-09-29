<?php

namespace App\Providers;

use App\Section;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        
        view()->composer(['master.front-master.includes.header','master.front-master.includes.sidebar'], function ($view) {
            $view->with(['sections' => Section::where('status', 1)->get()]);
        });
    }
}
