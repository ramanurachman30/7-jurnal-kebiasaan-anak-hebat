<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::extend('CUSTOM_AUTH', function ($app, $name, array $config) {
            $provider = new EloquentUserProvider($app['hash'], config('auth.providers.users.model'));

            $guard = new CustomAuth('CUSTOM_AUTH', $provider, app()->make('session.store'));
            $guard->setCookieJar($this->app['cookie']);
            return $guard;
        });

        //
    }
}
