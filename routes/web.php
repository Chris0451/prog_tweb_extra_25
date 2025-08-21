<?php

use App\Http\Controllers\AdminController;
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

//ROUTE PER LISTA PRODOTTI (LATO ADMIN)
Route::get('/admin/listProd', [AdminController::class,'listProducts'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('product.list');

//ROUTE PER FORM DI INSERIMENTO DEL PRODOTTO
Route::get('/admin/product/insert', [AdminController::class, 'addProduct'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('product.add');

//ROUTE PER AGGIUNTA DEL PRODOTTO AL DATABASE
Route::post('/admin/product', [AdminController::class, 'storeProduct'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('product.store');

//ROUTE PER FORM ALLA MODIFICA DEL PRODOTTO SELEZIONATO DALLA LISTA PRODOTTI
Route::get('/admin/product/update/{prodId}', [AdminController::class, 'editProduct'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('product.edit');

//ROUTE PER IMPOSTAZIONE MODIFICHE DEL NUOVO PRODOTTO
Route::put('admin/product/update', [AdminController::class, 'updateProduct'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('product.update');

require __DIR__.'/auth.php';
