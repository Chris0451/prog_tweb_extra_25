<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

//ROUTE PER HOMEPAGE
Route::get('/', [PublicController::class, 'showHome'])->name('home');

//-------------ROUTES DASHBOARD [UTENTI]-----------------//

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

//-------------BARRA DI RICERCA MALFUNZIONAMENTI/SOLUZIONI [HOMEPAGE]-----------------//

//ROUTE PER ESTRAZIONE MALFUNZIONAMENTI PRODOTTI TRAMITE SELECT
Route::get('/api/products/{product}/malfunctions', [PublicController::class, 'malfunctionsByProduct'])
    ->name('api.product.malfunctions');

//--------------MANIPOLAZIONE PRODOTTI [ADMIN]----------------//

//ROUTE PER LISTA PRODOTTI (LATO ADMIN)
Route::get('/admin/product/list', [AdminController::class,'listProducts'])
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

//ROUTE PER IMPOSTAZIONE MODIFICHE DEL NUOVO PRODOTTO NEL DATABASE
Route::put('admin/product/update', [AdminController::class, 'updateProduct'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('product.update');

//ROUTE PER CANCELLAZIONE PRODOTTO DALLA LISTA
Route::delete('admin/product/delete/{prodId}', [AdminController::class, 'deleteProduct'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('product.delete');

//------------MANIPOLAZIONE CENTRI DI ASSISTENZA [ADMIN]------------//

//ROUTE PER LISTA DI CENTRI DI ASSISTENZA (LATO ADMIN)
Route::get('admin/center/list', [AdminController::class, 'listCenters'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('center.list');

//ROUTE PER FORM DI INSERIMENTO DEL CENTRO DI ASSISTENZA
Route::get('/admin/center/insert', [AdminController::class, 'addCenter'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('center.add');

//ROUTE PER AGGIUNTA DEL CENTRO DI ASSISTENZA AL DATABASE
Route::post('/admin/center', [AdminController::class, 'storeCenter'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('center.store');

//ROUTE PER FORM ALLA MODIFICA DEL CENTRO DI ASSISTENZA SELEZIONATO DALLA LISTA DEI CENTRI
Route::get('/admin/center/update/{centerId}', [AdminController::class, 'editCenter'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('center.edit');

//ROUTE PER IMPOSTAZIONE MODIFICHE DEL NUOVO CENTRO DI ASSISTENZA NEL DATABASE
Route::put('admin/center/update', [AdminController::class, 'updateCenter'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('center.update');

//ROUTE PER FORM ALLA MODIFICA DEL CENTRO DI ASSISTENZA SELEZIONATO DALLA LISTA DEI CENTRI
Route::get('/admin/center/update/{centerId}', [AdminController::class, 'editCenter'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('center.edit');

//ROUTE PER CANCELLAZIONE CENTRO DI ASSISTENZA DALLA LISTA DEI CENTRI
Route::delete('admin/center/delete/{centerId}', [AdminController::class, 'deleteCenter'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('center.delete');

//------------MANIPOLAZIONE UTENTI(TECNICI E STAFF) [ADMIN]------------//



//------------MANIPOLAZIONE MALFUNZIONAMENTI [STAFF]------------//

//------------MANIPOLAZIONE SOLUZIONI [STAFF]------------//


require __DIR__.'/auth.php';
