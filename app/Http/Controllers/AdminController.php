<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCenterRequest;
use App\Http\Requests\NewProductAssignementRequest;
use App\Http\Requests\NewProductRequest;
use App\Http\Requests\NewStaffRequest;
use App\Http\Requests\NewTechnicRequest;
use App\Http\Requests\NewUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Admin;
use App\Models\Resources\AssegnazioneProdotto;
use App\Models\Resources\CentroAssistenza;
use App\Models\Resources\Prodotto;
use App\Models\Resources\Staff;
use App\Models\Resources\Tecnico;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
        return redirect()->action([DashboardController::class, 'index'])->with('success', 'Prodotto inserito correttamente');
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
        return redirect()->route('product.list')->with('success', 'Prodotto aggiornato'); //NOME DELLA ROUTE CHE UTILIZZA listProducts
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
    public function addUser(): View
    {
        $user = Auth::user();
        $centri = $this->_adminModel->getAllCenters();
        $prodotti = $this->_adminModel->getAllProducts();
        return view('layouts.users_layouts.admin.users.insert', ['user' => $user, 'centri' => $centri, 'prodotti' => $prodotti]);
        //return view('admin.users');
    }

    //INSERIMENTO UTENTE (TECNICO, STAFF) NEL DATABASE DOPO CONFERMA DEL FORM
    public function storeUser(NewUserRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $user = new User();
            $user->username = $data['username'];
            $user->password = Hash::make($data['password']);
            $user->nome     = $data['nome'];
            $user->cognome  = $data['cognome'];
            $user->role     = $data['role'];
            $user->save();

            if ($data['role'] === 'tecnico') {
                Tecnico::create([
                    'id_utente'            => $user->id,
                    'specializzazione'     => $data['specializzazione'],
                    'data_nascita'         => $data['data_nascita'],
                    'id_centro_assistenza' => $data['id_centro_assistenza'],
                ]);
            }

            if ($data['role'] === 'staff') {
                $staff = Staff::create(['id_utente' => $user->id]);
                $staff->prodotti()->sync($data['prodotti'] ?? []);
            }
        });

        return redirect()->action([DashboardController::class, 'index'])
            ->with('success','Utente inserito correttamente');
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
    public function editUser(int $userId, string $role): View
    {
        $user = Auth::user();
        switch ($role) {
            case 'tecnico':
                $utente_selezionato = $this->_adminModel->getTechnicById($userId);
                $centri = $this->_adminModel->getAllCenters();
                return view('layouts.users_layouts.admin.users.update', ['user' => $user, 'utente_selezionato' => $utente_selezionato, 'role' => $role, 'centri' => $centri]);
                break;

            case 'staff':
                $utente_selezionato = $this->_adminModel->getStaffWithProds($userId);
                $prodotti_assegnati = $utente_selezionato->staff?->prodotti->pluck('id')->toArray() ?? [];
                $prodotti = $this->_adminModel->getOrderProds();
                return view('layouts.users_layouts.admin.users.update', ['user' => $user, 'utente_selezionato' => $utente_selezionato, 'role' => $role, 'prodotti' => $prodotti, 'prodotti_assegnati' => $prodotti_assegnati]);
                break;

            default:
                abort(404);
        }
    }

    public function updateUser(UpdateUserRequest $request, string $role): RedirectResponse
    {

        $utente_selezionato = $this->_adminModel->getUserById($request->id);

        $utente_selezionato->fill($request->only(['username','nome','cognome','role']));

        if ($request->filled('password')) {
            $utente_selezionato->password = Hash::make($request->input('password'));
        }

        $utente_selezionato->save();

        switch ($role){
            case 'tecnico':
                $tecnico = $utente_selezionato->tecnico;
                $tecnico->fill($request->only(['specializzazione','data_nascita','id_centro_assistenza']));
                $tecnico->save();
                break;

            case 'staff':
                $staff = $utente_selezionato->staff;
                //SALVATAGGIO NUOVI PRODOTTI SELEZIONATI
                $prodotti_selezionati = $request->input('prodotti', []);
                $staff->prodotti()->sync($prodotti_selezionati);
                break;

            default:
                abort(404);
        }
        return redirect()->route('users.list')->with('success','Utente aggiornato');
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
        return redirect()->action([DashboardController::class, 'index'])->with('success', 'Centro inserito correttamente');
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
        return redirect()->route('center.list')->with('success', 'Centro aggiornato'); //NOME DELLA ROUTE CHE UTILIZZA listCenters
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
