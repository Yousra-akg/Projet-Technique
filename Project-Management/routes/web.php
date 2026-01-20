<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

use App\Http\Controllers\PublicTaskController;

Route::get('/', [PublicTaskController::class, 'index'])->name('home');
Route::get('/details/{task}', [PublicTaskController::class, 'show'])->name('public.tasks.show');

Route::resource('tasks', TaskController::class);
Route::get('/admin', [TaskController::class, 'index'])->name('admin.index');
