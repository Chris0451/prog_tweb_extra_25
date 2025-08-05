<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Resources;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    //sezione livello 2-3
    public function showMalfunctionsPerProds()
    {
        $malfunzionamenti = Catalog::getMalfunctionsByProds();
        return view('view_malfuncs', compact('malfunc_prods'));
    }

    public function showHome(Request $request)
    {
        
        $prodotti = Catalog::getPaginatedProds($request);
        $prodotti->withPath('/home');
        $centri = Catalog::getPaginatedCenters($request);
        $centri->withPath('/home');
        return view('home', [
            'prodotti' => $prodotti,
            'centri' => $centri,
        ]);
    }

}
