<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// https://stackoverflow.com/questions/44787458/laravel-passport-install-class-not-found
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    // https://www.tutsmake.com/create-rest-api-using-passport-laravel-5-8-authentication/
//    Use Schema;

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
    // https://www.tutsmake.com/create-rest-api-using-passport-laravel-5-8-authentication/
    // Schema::defaultStringLength(191);
        Passport::routes();
        //
    }
}
