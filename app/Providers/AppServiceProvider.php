<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
Use App\Custom\Services\UserService;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(User::class, function ($app) {
            return auth()->user();
        });
        $this->app->singleton(UserService::class, function ($app) {
            return new UserService(auth()->user());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
