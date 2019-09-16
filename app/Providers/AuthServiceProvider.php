<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * Grabbed from https://medium.com/@PhillyWebGuy/using-laravel-passport-to-authenticate-access-to-your-api-4412a764e57a
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();




    // https://laravel.io/forum/08-29-2016-passport-unauthenticated
    // Laravel says Carbon doesn't exist
/*    Passport::tokensExpireIn(Carbon::now()->addDays(7));

    Passport::refreshTokensExpireIn(Carbon::now()->addDays(14));
*/
    }
}
