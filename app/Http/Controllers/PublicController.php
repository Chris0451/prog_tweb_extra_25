<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Resources;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    //SEZIONE (***DA IMPLEMENTARE***) PER LIVELLO 2-3
    public function showMalfunctionsPerProds()
    {
        $malfunzionamenti = Catalog::getMalfunctionsByProds();
        return view('view_malfuncs', compact('malfunc_prods'));
    }
    //ESTRAZIONE PRODOTTI E CENTRI NELLE SEZIONE DELLA HOME
    public function showHome(Request $request)
    {
        
        $prodotti = Catalog::getPaginatedProds($request);
        $centri = Catalog::getPaginatedCenters($request);
        
        return view('home', [
            'prodotti' => $prodotti,
            'centri' => $centri,
        ]);
    }

}
