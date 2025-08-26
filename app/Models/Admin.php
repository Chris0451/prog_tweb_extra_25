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
    public function getPagedProducts(): LengthAwarePaginator{
        return Prodotto::orderBy('id', 'asc')->paginate(5);
    }

    public function getAllProducts(){
        return Prodotto::orderBy('id')->get(['id', 'nome']);
    }

    public function getOrderProds(){
        return Prodotto::orderBy('id')->get(['id','nome']);
    }

    //ESTRAZIONE PRODOTTO TRAMITE IL PROPRIO ID
    public function getProductById(int $prodId){
        return Prodotto::find($prodId);
    }

    //-----------------------------------//

    //ESTRAZIONE TECNICI ORDINATI PER ID E PAGINATI A 5 ELEMENTI
    public function getPagedTechnics(): LengthAwarePaginator{
        return User::with(['tecnico.centro'])->whereHas('tecnico')->orderBy('id', 'asc')->paginate(5);
    }

    //ESTRAZIONE TECNICO TRAMITE ID UTENTE
    public function getTechnicById(int $userId){
        return User::with(['tecnico.centro'])->whereHas('tecnico')->where('id', $userId)->first();
    }

    //-----------------------------------//

    //ESTRAZIONE STAFF ORDINATI PER ID E PAGINATI A 5 ELEMENTI
    public function getPagedStaff(): LengthAwarePaginator{
        return User::with(['staff.prodotti'])->whereHas('staff')->orderBy('id', 'asc')->paginate(5);
    }

    //ESTRAZIONE STAFF TRAMITE IL PROPRIO ID
    public function getStaffById(int $userId){
        return User::with(['staff.prodotti'])->whereHas('staff')->where('id', $userId)->first();
    }

    public function getStaffWithProds(int $userId){
        return User::with('staff.prodotti:id,nome')->findOrFail($userId);
    }

    //-----------------------------------//

    public function getUserById(int $userId){
        return User::with(['tecnico','staff'])->findOrFail($userId);
    }

    //ESTRAZIONE STAFF ORDINATI PER ID E PAGINATI A 5 ELEMENTI
    public function getPagedCenters(): LengthAwarePaginator{
        return CentroAssistenza::orderBy('id', 'asc')->paginate(5);
    }

    public function getAllCenters(){
        return CentroAssistenza::orderBy('id')->pluck('nome', 'id')->toArray();
    }

    //ESTRAZIONE STAFF TRAMITE IL PROPRIO ID
    public function getCenterById(int $centerId){
        return CentroAssistenza::find($centerId);
    }

}
