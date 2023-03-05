<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

        Gate::define('admin-panel', function (User $user) {
            return $user->permissions->containsStrict('name', 'admin-panel');
        });

        Gate::define('actions on invoices', function (User $user) {
            return $user->permissions->containsStrict('name', 'actions on invoices');
        });

        Gate::define('actions on products', function (User $user) {
            return $user->permissions->containsStrict('name', 'actions on products');
        });

        Gate::define('actions on stocks', function (User $user) {
            return $user->permissions->containsStrict('name', 'actions on stocks');
        });
    }
}
