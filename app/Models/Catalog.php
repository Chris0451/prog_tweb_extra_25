<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Resources\Prodotto;
use App\Models\Resources\Malfunzionamento;
use App\Models\Resources\CentroAssistenza;
use App\Models\Resources\SoluzioneTecnica;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Catalog
{

    //PRODOTTI PAGINATI NELLA HOME (CON MALFUNZIONAMENTI E SOLUZIONI RELATIVE PER IL TECNICO)
    public static function getPaginatedProds($request, $perPage = 3)
    {
        $isTecnico = Auth::check() && Auth::user()->ruolo === 'tecnico';

        $query = Prodotto::query();
        
        // eager load SOLO per tecnico
        if ($isTecnico) {
            $query->with(['malfunzionamento.soluzione_tecnica']);
        }

        //RICERCA TESTUALE PER PRODOTTI DALLA LORO DESCRIZIONE
        if ($request->has('search_prod') && trim($request->input('search_prod')) !== '') {
            $search = $request->input('search_prod');
            //RICERCA CON CARATTERE CON WILDCARD "*"
            if (substr($search, -1) === '*') {
                $like = str_replace('*', '%', $search);
                $query->where('descrizione', 'LIKE', "%$like");
            } else {
                //RICERCA PAROLA INTERA CONTENUTA NELLA DESCRIZIONE
                $escaped = preg_quote($search, '/');
                $query->whereRaw("descrizione REGEXP '[[:<:]]{$escaped}[[:>:]]'");
            }
        }

        // RICERCA TESTULE PER MALFUNZIONAMENTI DALLA LORO DESCRIZIONE
        if ($request->filled('search_malf')) {
            $term = $request->input('search_malf');
            $escaped = preg_quote($term, '/');
            $query->whereHas('malfunzionamento', function ($q) use ($escaped) {
                $q->whereRaw("descrizione REGEXP '[[:<:]]{$escaped}[[:>:]]'");
            });
        }

        // FILTRO PER PRODOTTO
        if ($request->filled('prod_id')) {
            $query->where('id', $request->integer('prod_id'));
        }

        // FILTRO PER MALFUNZIONAMENTO (filtra prodotti che hanno quel malfunzionamento)
        if ($request->filled('malf_id')) {
            $malfId = $request->integer('malf_id');
            $query->whereHas('malfunzionamento', function ($q) use ($malfId) {
                $q->where('id', $malfId);
            });
        }

        return $query
               ->paginate($perPage, ['*'], 'prodotti_page')
               ->appends($request->all());
    }


    //CENTRI DI ASSISTENZA PAGINATI NELLA HOME
    public static function getPaginatedCenters($request, $perPage = 3)
    {
        return CentroAssistenza::paginate($perPage, ['*'], 'centri_page')->appends($request->all());
    }

    public static function prodsAll()
    {
        return Prodotto::all();
    }
    
    //ESTRAZIONE DI MALFUNZIONAMENTI E SOLUZIONI ASSOCIATE PER LIVELLO 3
    public static function getMalfunctionsByProds(){
        return Malfunzionamento::with('prodotto')->get();
    }

}
