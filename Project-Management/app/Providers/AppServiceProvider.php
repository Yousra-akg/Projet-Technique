<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Task;

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

        // Gates pour les tâches
        \Illuminate\Support\Facades\Gate::define('create-task', function ($user) {
            return !$user->isAdmin(); // Seuls les non-admins (éditeurs) peuvent créer des tâches
        });

        \Illuminate\Support\Facades\Gate::define('manage-task', function ($user, Task $task) {
            return $user->isAdmin() || $user->id === $task->user_id;
        });

        // Anciens gates (si nécessaires)
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
