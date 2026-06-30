<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use App\Services\SSOProvider;
use App\Services\SSOLdapProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Socialite::extend('sso', function ($app) {
            $config = $app['config']['services.sso'];

            return Socialite::buildProvider(SSOProvider::class, $config);
        });

        Socialite::extend('sso_ldap', function ($app) {
            $config = $app['config']['services.sso_ldap'];

            return Socialite::buildProvider(SSOLdapProvider::class, $config);
        });
    }
}
