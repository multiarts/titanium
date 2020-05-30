<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function($user){
            return $user->hasRole('admin');
        });
        
        Gate::define('delete', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('edit', function($user){
            return $user->hasAnyRoles(['admin', 'gerente', 'analista']);
        });

        Gate::define('gerente', function($user){
            return $user->hasAnyRoles(['admin', 'gerente']);
        });

        Gate::define('profile', function($user){
            return $user->hasAnyRoles(['analista', 'gerente']);
        });

        Gate::define('analista', function($user){
            return $user->hasRole('analista');
        });
    }
}
