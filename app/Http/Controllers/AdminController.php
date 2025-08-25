<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCenterRequest;
use App\Http\Requests\NewProductRequest;
use App\Http\Requests\NewStaffRequest;
use App\Http\Requests\NewTechnicRequest;
use App\Http\Requests\NewUserRequest;
use App\Models\Admin;
use App\Models\Resources\CentroAssistenza;
use App\Models\Resources\Prodotto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminController extends Controller
{

    protected $_adminModel;

    public function __construct() {
        $this->_adminModel = new Admin;
    }

    //RESTITUZIONE VIEW PER IL FORM DI INSERIMENTO DEL PRODOTTO
    public function addProduct(): View
    {
        $user = Auth::user();
        return view('layouts.users_layouts.admin.products.insert', ['user' => $user]);
    }

    //INSERIMENTO PRODOTTO NEL DATABASE DOPO CONFERMA DEL FORM
    public function storeProduct(NewProductRequest $request): RedirectResponse
    {
        $prodotto = new Prodotto;
        $prodotto->fill($request->validated());

        if (!is_null($request->file('foto'))) {
            $prodotto->foto = basename($request->file('foto')->store('images/products', 'public'));
        }
        $prodotto->save();
        return redirect()->action([DashboardController::class, 'index']);
    }

    //RESTITUZIONE VIEW PER LISTA PRODOTTI PAGNIATA
    public function listProducts() //:View
    {
        $user = Auth::user();
        $prods = $this->_adminModel->getPagedProducts();
        return view('layouts.users_layouts.admin.products.list', ['user' => $user,'prodotti' => $prods]);
    }

    public function editProduct(int $prodId): View
    {
        $user = Auth::user();
        $prodotto = $this->_adminModel->getProductById($prodId);
        return view('layouts.users_layouts.admin.products.update', ['prodotto' => $prodotto, 'user' => $user]);
    }

    public function updateProduct(NewProductRequest $request): RedirectResponse
    {
        $prodotto = $this->_adminModel->getProductById($request->input('id'));
        $oldImg = $prodotto->foto;
        $prodotto->update($request->validated());
        if (!is_null($request->file('foto'))) {
            $prodotto->update(['foto' => basename($request->file('foto')->store('images/products', 'public'))]);
            if (!is_null($oldImg)) {
                Storage::disk('public')->delete('images/products/'.$oldImg);
            }
        }
        return redirect()->route('product.list'); //NOME DELLA ROUTE CHE UTILIZZA listProducts
    }

    public function deleteProduct(int $prodId): RedirectResponse
    {
        $prodotto = $this->_adminModel->getProductById($prodId);
        $foto = $prodotto->foto;
        $prodotto->delete();
        if (!is_null($foto)) {
            Storage::disk('public')->delete('images/products/'.$foto);
        }
        return redirect()->route('product.list'); //NOME DELLA ROUTE CHE UTILIZZA listProducts
    }

    //-----------------------------------//

    //RESTITUZIONE VIEW PER L'INSERIMENTO DELL'UTENTE (TECNICO, STAFF) NEL DATABASE
    public function addUser() //: View
    {
        //return view('admin.users');
    }

    //INSERIMENTO UTENTE (TECNICO, STAFF) NEL DATABASE DOPO CONFERMA DEL FORM
    public function storeUser(NewUserRequest $request)
    {
        //
    }

    //RESTITUZIONE VIEW CON TABELLA UTENTI (TECNICO, STAFF)
    public function listUsers(): View
    {
        $user = Auth::user();
        $tecnici = $this->_adminModel->getPagedTechnics();
        $staffs = $this->_adminModel->getPagedStaff();
        return view('layouts.users_layouts.admin.users.list', ['user' => $user, 'tecnici' => $tecnici, 'staffs' => $staffs]);
    }

    //RESTITUZIONE VIEW PER FORM DI MODIFICA UTENTE (TECNICO, STAFF) 
    public function editUser(int $userId, string $role, int $id): View
    {
        $user = Auth::user();
        switch ($role) {
            case 'tecnico':
                $utente_selezionato = $this->_adminModel->getTechnicById($userId);
                $centri = $this->_adminModel->getAllCenters();
                return view('layouts.users_layouts.admin.users.update', ['user' => $user, 'utente_selezionato' => $utente_selezionato, 'role' => $role, 'centri' => $centri]);
                break;

            case 'staff':
                $utente_selezionato = $this->_adminModel->getStaffWithProds($id);
                $prodotti = $this->_adminModel->getOrderProds();
                $prodotti_assegnati = $utente_selezionato->prodotti->pluck('id')->toArray();
                return view('layouts.users_layouts.admin.users.update', ['user' => $user, 'utente_selezionato' => $utente_selezionato, 'role' => $role, 'prodotti' => $prodotti, 'prodotti_assegnati' => $prodotti_assegnati]);
                break;

            default:
                abort(404);
        }
        return view('layouts.users_layouts.admin.users.update', ['user' => $user, 'utente_selezionato' => $utente_selezionato, 'role' => $role]);
    }

    public function updateUser(NewUserRequest $request, string $role): RedirectResponse
    {
        switch ($role){
            case 'tecnico':
                $tecnico = $this->_adminModel->getTechnicById($request->input('id'));
                $techData = $request->validated();
                $techData['password'] = Hash::make($techData['password']);
                $tecnico->update($techData);
                break;

            case 'staff':
                $staff = $this->_adminModel->getStaffById($request->input('id'));
                $staffData = $request->validated();
                $staffData['password'] = Hash::make($staffData['password']);
                $staff->update($staffData);
                break;

            default:
                abort(404);
        }
        return redirect()->route('users.list');
    }

    //AZIONE DI CANCELLAZIONE DI UN UTENTE (TECNICO, STAFF) SELEZIONATO
    public function deleteUser(int $userId): RedirectResponse
    {
        $utente_selezionato = $this->_adminModel->getUserById($userId);
        $utente_selezionato->delete();
        return redirect()->route('users.list'); //NOME DELLA ROUTE CHE UTILIZZA listUsers
    }

    //-----------------------------------//

    //RESTITUZIONE VIEW PER L'INSERIMENTO DEL CENTRO DI ASSISTENZA NEL DATABASE
    public function addCenter(): View
    {
        $user = Auth::user();
        return view('layouts.users_layouts.admin.centers.insert', ['user' => $user]);
    }

    //INSERIMENTO CENTRO ASSISTENZA NEL DATABASE DOPO CONFERMA DEL FORM
    public function storeCenter(NewCenterRequest $request): RedirectResponse
    {
        $centro = new CentroAssistenza;
        $centro->fill($request->validated());

        if (!is_null($request->file('foto'))) {
            $centro->foto = basename($request->file('foto')->store('images/assistance_centers', 'public'));
        }
        $centro->save();
        return redirect()->action([DashboardController::class, 'index']);
    }

    public function listCenters() :View
    {
        $user = Auth::user();
        $centers = $this->_adminModel->getPagedCenters();
        return view('layouts.users_layouts.admin.centers.list',['user' => $user, 'centri' => $centers]);
    }

    public function editCenter(int $centerId): View
    {
        $user = Auth::user();
        $centro = $this->_adminModel->getCenterById($centerId);
        return view('layouts.users_layouts.admin.centers.update', ['centro' => $centro, 'user' => $user]);
    }

    public function updateCenter(NewCenterRequest $request): RedirectResponse
    {
        $centro = $this->_adminModel->getCenterById($request->input('id'));
        $oldImg = $centro->foto;
        $centro->update($request->validated());
        if (!is_null($request->file('foto'))) {
            $centro->update(['foto' => basename($request->file('foto')->store('images/assistance_centers', 'public'))]);
            if (!is_null($oldImg)) {
                Storage::disk('public')->delete('images/assistance_centers/'.$oldImg);
            }
        }
        return redirect()->route('center.list'); //NOME DELLA ROUTE CHE UTILIZZA listCenters
    }

    public function deleteCenter(int $centerId): RedirectResponse
    {
        $centro = $this->_adminModel->getCenterById($centerId);
        $foto = $centro->foto;
        $centro->delete();
        if (!is_null($foto)) {
            Storage::disk('public')->delete('images/assistance_centers/'.$foto);
        }
        return redirect()->route('center.list'); //NOME DELLA ROUTE CHE UTILIZZA listCenters
    }
}
