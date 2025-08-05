<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Prodotto;
use App\Models\Resources\Malfunzionamento;
use App\Models\Resources\SoluzioneTecnica;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Catalog
{
    public static function getPaginatedProds($perPage = 3)
    {
        return Prodotto::paginate($perPage);
    }

    public static function getProds(){
        return Prodotto::all();
    }
    
    public static function getMalfunctionsByProds(){
        return Malfunzionamento::with('prodotto')->get();
    }

}
