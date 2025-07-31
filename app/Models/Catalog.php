<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use app\Models\Resources\Prodotto;
use App\Models\Resources\Malfunzionamento;
use App\Models\Resources\SoluzioneTecninca;
use Illuminate\Database\Eloquent\Collection;

class Catalog
{
    public static function getProds(){
        return Prodotto::all();
    }
    
    public static function getMalfunctionsByProds(){
        return Malfunzionamento::with('prodotto')->get();
    }

}
