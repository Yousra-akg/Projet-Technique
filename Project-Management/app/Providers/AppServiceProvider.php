<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Gates
        \Illuminate\Support\Facades\Gate::define('access-admin', function ($user) {
            return $user->isAdmin() || $user->isEditor();
        });

        \Illuminate\Support\Facades\Gate::define('manage-tasks', function ($user) {
            return $user->isAdmin() || $user->isEditor();
        });

        \Illuminate\Support\Facades\Gate::define('delete-task', function ($user) {
            return $user->isAdmin();
        });
    }
}
