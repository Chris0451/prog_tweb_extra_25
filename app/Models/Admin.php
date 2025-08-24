<?php

namespace App\Models;

use App\Models\Resources\CentroAssistenza;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Resources\Prodotto;
use App\Models\Resources\Staff;
use App\Models\Resources\Tecnico;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Admin extends Model
{

    //ESTRAZIONE PRODOTTI ORDINATI PER ID E PAGINATI A 5 ELEMENTI
    public function getPagedProducts(): LengthAwarePaginator
    {
        return Prodotto::orderBy('id', 'asc')->paginate(5);
    }

    public function getAllProducts()
    {
        return Prodotto::all();
    }

    public function getOrderProds()
    {
        return Prodotto::orderBy('nome')->get(['id','nome']);
    }

    //ESTRAZIONE PRODOTTO TRAMITE IL PROPRIO ID
    public function getProductById(int $prodId)
    {
        return Prodotto::find($prodId);
    }

    //-----------------------------------//

    //ESTRAZIONE TECNICI ORDINATI PER ID E PAGINATI A 5 ELEMENTI
    public function getPagedTechnics(): LengthAwarePaginator
    {
        return Tecnico::with(['utente', 'centro'])->orderBy('id', 'asc')->paginate(5);
    }

    //ESTRAZIONE TECNICO TRAMITE IL PROPRIO ID
    public function getTechnicById(int $userId)
    {
        return Tecnico::with('utente')->where('id_utente', $userId)->first();
    }

    //-----------------------------------//

    //ESTRAZIONE STAFF ORDINATI PER ID E PAGINATI A 5 ELEMENTI
    public function getPagedStaff(): LengthAwarePaginator
    {
        return Staff::with(['utente', 'prodotti'])->orderBy('id', 'asc')->paginate(5);
    }

    //ESTRAZIONE STAFF TRAMITE IL PROPRIO ID
    public function getStaffById(int $userId)
    {
        return Staff::with(['utente', 'prodotti'])->where('id_utente', $userId)->first();
    }

    public function getStaffWithProds(int $staffId){
        return Staff::with('prodotti:id')->findOrFail($staffId);
    }

    //-----------------------------------//

    public function getUserById(int $userId)
    {
        return User::find($userId);
    }

    //ESTRAZIONE STAFF ORDINATI PER ID E PAGINATI A 5 ELEMENTI
    public function getPagedCenters(): LengthAwarePaginator
    {
        return CentroAssistenza::orderBy('id', 'asc')->paginate(5);
    }

    public function getAllCenters()
    {
        return CentroAssistenza::orderBy('nome')->pluck('nome', 'id')->toArray();
    }

    //ESTRAZIONE STAFF TRAMITE IL PROPRIO ID
    public function getCenterById(int $centerId)
    {
        return CentroAssistenza::find($centerId);
    }

}
