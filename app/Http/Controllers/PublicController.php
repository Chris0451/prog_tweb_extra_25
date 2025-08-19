<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Resources\Prodotto;
use App\Models\Resources\Malfunzionamento;
use App\Models\Resources;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    //ESTRAZIONE PRODOTTI E CENTRI NELLE SEZIONE DELLA HOME, CON MALFUNZIONAMENTI E SOLUZIONI PER L'ACCESSO AL TECNICO
    public function showHome(Request $request)
    {
        
        $prodottiPaginati = Catalog::getPaginatedProds($request);
        
        $centri = Catalog::getPaginatedCenters($request);
        
        $prodottiAll = Catalog::prodsAll();
        
        return view('home', [
            'prodotti' => $prodottiPaginati,
            'centri' => $centri,
            'prodotti_select' => $prodottiAll,
        ]);
    }

    //SEZIONE PER LIVELLO 2-3
    // Endpoint AJAX: malfunzionamenti di un prodotto
    public function malfunctionsByProduct(Prodotto $product)
    {
        $malf = Malfunzionamento::where('id_prodotto', $product->id)
            ->orderBy('tipologia')
            ->get(['id', 'tipologia']); 

        return response()->json($malf);
    }
}
