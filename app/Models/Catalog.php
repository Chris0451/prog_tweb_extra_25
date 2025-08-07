<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Prodotto;
use App\Models\Resources\Malfunzionamento;
use App\Models\Resources\CentroAssistenza;
use App\Models\Resources\SoluzioneTecnica;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Catalog
{
    public static function getPaginatedProds($request, $perPage = 3)
    {
        $query = Prodotto::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
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

        return $query->paginate($perPage, ['*'], 'prodotti_page')->appends($request->all());

        //return Prodotto::paginate($perPage, ['*'], 'prodotti_page')->appends($request->all());
    }

    public static function getPaginatedCenters($request, $perPage = 3)
    {
        return CentroAssistenza::paginate($perPage, ['*'], 'centri_page')->appends($request->all());
    }

    public static function prodsQuery(){
        return Prodotto::query();
    }
    
    public static function getMalfunctionsByProds(){
        return Malfunzionamento::with('prodotto')->get();
    }

}
