<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PublicTaskController;
use App\Http\Controllers\TaskController;

// Public Routes
Route::get('/', [PublicTaskController::class, 'index'])->name('home');
Route::get('/details/{task}', [PublicTaskController::class, 'show'])->name('public.tasks.show');

// Authentication Routes
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home_auth');

// Admin Routes (Protected by Auth and Gate)
Route::middleware(['auth', 'can:access-admin'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::get('/admin', [TaskController::class, 'index'])->name('admin.index');
});
