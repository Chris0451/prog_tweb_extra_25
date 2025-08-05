<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Resources;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    
    public function showProducts()
    {
        $prodotti = Catalog::getPaginatedProds();
        $prodotti->withPath('/home');
        return view('home', compact('prodotti'));
    }

    public function showMalfunctionsPerProds()
    {
        $malfunzionamenti = Catalog::getMalfunctionsByProds();
        return view('view_malfuncs', compact('malfunc_prods'));
    }
}
