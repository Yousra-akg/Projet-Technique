<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
    
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Gate::define('access-admin', function (User $user): bool {
            return in_array($user->role, ['admin', 'editor'], true);
        });

        Gate::define('manage-tasks', function (User $user): bool {
            return in_array($user->role, ['admin', 'editor'], true);
        });

        Gate::define('delete-task', function (User $user): bool {
            return $user->role === 'admin';
        });
    }
}
