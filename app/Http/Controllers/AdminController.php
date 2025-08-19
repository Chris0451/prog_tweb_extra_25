<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCenterRequest;
use App\Http\Requests\NewProductRequest;
use App\Http\Requests\NewUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    //RESTITUZIONE VIEW PER IL FORM DI INSERIMENTO DEL PRODOTTO
    public function addProduct() //: View
    {
        //return view('admin.product');
    }

    //RESTITUZIONE VIEW PER LISTA PRODOTTI PAGNIATA
    public function listProducts() //:View
    {
        //return view('product.list');
    }

    //INSERIMENTO PRODOTTO NEL DATABASE DOPO CONFERMA DEL FORM
    public function storeProduct(NewProductRequest $request)
    {

    }

    public function editProduct(NewProductRequest $request)//: RedirectResponse
    {
        //return redirect()->route('listprod'); //NOME DELLA ROUTE CHE UTILIZZA listProducts
    }

    public function deleteProduct(NewProductRequest $request)//: RedirectResponse
    {
        //return redirect()->route('listprod'); //NOME DELLA ROUTE CHE UTILIZZA listProducts
    }

    //-----------------------------------//

    //RESTITUZIONE VIEW PER L'INSERIMENTO DELL'UTENTE (TECNICO, STAFF) NEL DATABASE
    public function addUser() //: View
    {
        //return view('admin.users');
    }

    public function listUsers() //:View
    {
        //return view(admin.users);
    }

    //INSERIMENTO UTENTE (TECNICO, STAFF) NEL DATABASE DOPO CONFERMA DEL FORM
    public function storeUser(NewUserRequest $request)
    {

    }

    public function editUser(NewUserRequest $request)//: RedirectResponse
    {
        //return redirect()->route('listusers'); //NOME DELLA ROUTE CHE UTILIZZA listUsers
    }

    public function deleteUser(NewUserRequest $request)//: RedirectResponse
    {
        //return redirect()->route('listusers'); //NOME DELLA ROUTE CHE UTILIZZA listUsers
    }

    //-----------------------------------//

    //RESTITUZIONE VIEW PER L'INSERIMENTO DEL CENTRO DI ASSISTENZA NEL DATABASE
    public function addCenter() //:View
    {
        // return view('admin.centers')
    }

    public function listCenters() //:View
    {
        //return view(centers.list);
    }

    //INSERIMENTO UTENTE (TECNICO, STAFF) NEL DATABASE DOPO CONFERMA DEL FORM
    public function storeCenter(NewCenterRequest $request)
    {

    }

    public function editCenter(NewCenterRequest $request)//: RedirectResponse
    {
        //return redirect()->route('listcenters'); //NOME DELLA ROUTE CHE UTILIZZA listCenters
    }

    public function deleteCenter(NewCenterRequest $request)//: RedirectResponse
    {
        //return redirect()->route('listcenters'); //NOME DELLA ROUTE CHE UTILIZZA listCenters
    }
}
