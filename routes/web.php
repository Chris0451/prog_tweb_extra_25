<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'showHome'])->name('home');

Route::get('/dashboard/tecnico', [DashboardController::class, 'index'])
    ->middleware(['auth', RoleMiddleware::class . ':tecnico'])
    ->name('dashboard.tecnico');

Route::get('/dashboard/staff', [DashboardController::class, 'index'])
    ->middleware(['auth', RoleMiddleware::class . ':staff'])
    ->name('dashboard.staff');


Route::get('/dashboard/admin', [DashboardController::class, 'index'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('dashboard.admin');

require __DIR__.'/auth.php';
