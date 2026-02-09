<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicTaskController;

Route::get('/', [PublicTaskController::class, 'index'])->name('home');
Route::get('/details/{task}', [PublicTaskController::class, 'show'])->name('public.tasks.show');
