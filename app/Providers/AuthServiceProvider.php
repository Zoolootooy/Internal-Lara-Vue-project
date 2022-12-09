<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Page::class => PagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->gate();
    }

    /**
     * @return null
     */
    public function gate()
    {
        /**
         * @can('<unit>.<action>')
         */
        Gate::before(function (User $user, $permission) {
            if ($user->isSuperAdmin() && !strstr(url()->current(), 'countries')
                    || $user->hasPermission($permission)) {
                return true;
            }
        });

        /**
         * @can('<actino>', Model::class)
         */
        Gate::guessPolicyNamesUsing(function ($modelClass) {
            return 'App\\Policies\\' . class_basename($modelClass) . 'Policy';
        });
    }
}
