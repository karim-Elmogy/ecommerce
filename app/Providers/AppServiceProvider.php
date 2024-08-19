<?php

namespace App\Providers;

use App\Models\Dashboard\Advertisement;
use App\Models\Dashboard\City;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
//        $cities=City::orderBy('order','asc')->get();
//        View::share(get_defined_vars());
        Schema::defaultStringLength(191);
    }
}
