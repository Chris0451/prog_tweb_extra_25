<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\StaffController;
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
Route::get('/admin/product/add', [AdminController::class, 'addProduct'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('product.add');

//ROUTE PER AGGIUNTA DEL PRODOTTO AL DATABASE
Route::post('/admin/product/store', [AdminController::class, 'storeProduct'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('product.store');

//ROUTE PER FORM ALLA MODIFICA DEL PRODOTTO SELEZIONATO DALLA LISTA PRODOTTI
Route::get('/admin/product/edit/{prodId}', [AdminController::class, 'editProduct'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('product.edit');

//ROUTE PER IMPOSTAZIONE MODIFICHE DEL NUOVO PRODOTTO NEL DATABASE
Route::put('/admin/product/update', [AdminController::class, 'updateProduct'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('product.update');

//ROUTE PER CANCELLAZIONE PRODOTTO DALLA LISTA
Route::delete('/admin/product/delete/{prodId}', [AdminController::class, 'deleteProduct'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('product.delete');

//------------MANIPOLAZIONE CENTRI DI ASSISTENZA [ADMIN]------------//

//ROUTE PER LISTA DI CENTRI DI ASSISTENZA (LATO ADMIN)
Route::get('/admin/center/list', [AdminController::class, 'listCenters'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('center.list');

//ROUTE PER FORM DI INSERIMENTO DEL CENTRO DI ASSISTENZA
Route::get('/admin/center/add', [AdminController::class, 'addCenter'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('center.add');

//ROUTE PER AGGIUNTA DEL CENTRO DI ASSISTENZA AL DATABASE
Route::post('/admin/center/store', [AdminController::class, 'storeCenter'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('center.store');

//ROUTE PER FORM ALLA MODIFICA DEL CENTRO DI ASSISTENZA SELEZIONATO DALLA LISTA DEI CENTRI
Route::get('/admin/center/edit/{centerId}', [AdminController::class, 'editCenter'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('center.edit');

//ROUTE PER IMPOSTAZIONE MODIFICHE DEL NUOVO CENTRO DI ASSISTENZA NEL DATABASE
Route::put('/admin/center/update', [AdminController::class, 'updateCenter'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('center.update');

//ROUTE PER CANCELLAZIONE CENTRO DI ASSISTENZA DALLA LISTA DEI CENTRI
Route::delete('/admin/center/delete/{centerId}', [AdminController::class, 'deleteCenter'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('center.delete');

//------------MANIPOLAZIONE UTENTI(TECNICI E STAFF) [ADMIN]------------//

Route::get('/admin/users/list', [AdminController::class, 'listUsers'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('users.list');

Route::get('/admin/user/add', [AdminController::class, 'addUser'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('user.add');

Route::post('/admin/user/store', [AdminController::class, 'storeUser'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('user.store');

Route::get('/admin/user/edit/userId/{userId}/role/{role}/id/{id}', [AdminController::class, 'editUser'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('users.edit');

Route::put('/admin/user/update/{role}', [AdminController::class, 'updateUser'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('users.update');

Route::delete('/admin/user/delete/{userId}', [AdminController::class, 'deleteUser'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('user.delete');

//------------MANIPOLAZIONE MALFUNZIONAMENTI [STAFF]------------//

Route::get('/staff/malfunctions/list', [StaffController::class, 'listMalfunctions'])
    ->middleware(['auth', RoleMiddleware::class . ':staff'])
    ->name('malfunctions.list');

Route::get('/staff/malfunction/insert', [StaffController::class, 'insertMalfunction'])
    ->middleware(['auth', RoleMiddleware::class . ':staff'])
    ->name('malfunction.add');

Route::post('/staff/malfunction/store', [StaffController::class, 'storeMalfunction'])
    ->middleware(['auth', RoleMiddleware::class . ':staff'])
    ->name('malfunction.store');

Route::get('/staff/malfunction/edit/{malfId}', [StaffController::class, 'editMalfunction'])
    ->middleware(['auth', RoleMiddleware::class . ':staff'])
    ->name('malfunction.edit');

Route::put('/staff/malfunction/update', [StaffController::class, 'updateMalfunction'])
    ->middleware(['auth', RoleMiddleware::class . ':staff'])
    ->name('malfunction.update');

Route::delete('/staff/malfunction/delete/{malfId}', [StaffController::class, 'deleteMalfunction'])
    ->middleware(['auth', RoleMiddleware::class . ':staff'])
    ->name('malfunction.delete');

//------------MANIPOLAZIONE SOLUZIONI [STAFF]------------//

Route::get('/staff/solutions/list', [StaffController::class, 'listSolutions'])
    ->middleware(['auth', RoleMiddleware::class . ':staff'])
    ->name('solutions.list');

Route::get('/staff/solution/insert', [StaffController::class, 'insertSolution'])
    ->middleware(['auth', RoleMiddleware::class . ':staff'])
    ->name('solution.add');

Route::post('/staff/solution/store', [StaffController::class, 'storeSolution'])
    ->middleware(['auth', RoleMiddleware::class . ':staff'])
    ->name('solution.store');

Route::get('/staff/solution/edit/{solId}', [StaffController::class, 'editSolution'])
    ->middleware(['auth', RoleMiddleware::class . ':staff'])
    ->name('solution.edit');

Route::put('/staff/solution/update', [StaffController::class, 'updateSolution'])
    ->middleware(['auth', RoleMiddleware::class . ':staff'])
    ->name('solution.update');

Route::delete('/staff/solution/delete/{solId}', [StaffController::class, 'deleteSolution'])
    ->middleware(['auth', RoleMiddleware::class . ':staff'])
    ->name('solution.delete');



require __DIR__.'/auth.php';
