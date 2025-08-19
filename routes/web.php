<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

//ROUTER PER HOMEPAGE
Route::get('/', [PublicController::class, 'showHome'])->name('home');

//ROUTER PER DASHBOARD TECNICO
Route::get('/tecnico/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', RoleMiddleware::class . ':tecnico'])
    ->name('dashboard.tecnico');

//ROUTER PER DASHBOARD STAFF
Route::get('/staff/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', RoleMiddleware::class . ':staff'])
    ->name('dashboard.staff');

//ROUTER PER DASHBOARD ADMIN
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('dashboard.admin');

//ROUTE PER ESTRAZIONE MALFUNZIONAMENTI PRODOTTI TRAMITE SELECT
Route::get('/api/products/{product}/malfunctions', [PublicController::class, 'malfunctionsByProduct'])
    ->name('api.product.malfunctions');

require __DIR__.'/auth.php';
