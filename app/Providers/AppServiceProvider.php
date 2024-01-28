<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
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
        if(!app()->runningInConsole()){
            $setting = Setting::firstOr(function () {
                return Setting::create([
                     'title' => 'store',
                     'desc' => 'Laravel'
                 ]);
              });
      
      
              view()->share('setting', $setting);
        }
        Paginator::useBootstrap();

    }
}
