<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicTaskController;
use App\Http\Controllers\TaskController;

// Public Routes
Route::get('/', [PublicTaskController::class, 'index'])->name('home');
Route::get('/details/{task}', [PublicTaskController::class, 'show'])->name('public.tasks.show');

// Admin Routes
Route::resource('tasks', TaskController::class);
Route::get('/admin', [TaskController::class, 'index'])->name('admin.index');
