<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    
    public function showProducts()
    {
        $prodotti = Catalog::getProds();

        return view('home_layouts.products', compact('prodotti'));
    }

    public function showMalfunctionsPerProds()
    {
        $malfunzionamenti = Catalog::getMalfunctionsByProds();

        return view('view_malfuncs', compact('malfunc_prods'));
    }
}
