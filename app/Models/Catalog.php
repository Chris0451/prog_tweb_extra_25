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
        return Prodotto::paginate($perPage, ['*'], 'prodotti_page')->appends($request->all());
    }

    public static function getPaginatedCenters($request, $perPage = 3)
    {
        return CentroAssistenza::paginate($perPage, ['*'], 'centri_page')->appends($request->all());
    }

    public static function getProds(){
        return Prodotto::all();
    }
    
    public static function getMalfunctionsByProds(){
        return Malfunzionamento::with('prodotto')->get();
    }

}
