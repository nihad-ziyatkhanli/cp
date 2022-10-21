<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Custom\Services\MenuItemService;

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

        /* Registering all permissions. */
        $permissions = config('cp.permissions');
        foreach ($permissions as $p) {
            Gate::define($p, function ($user) use ($p) {
                // Loads roles into user on first call (Gate feature)
                return $user->permissions()->contains($p);
            });
        }
    }
}
