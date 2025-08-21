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

    //ESTRAZIONE PRODOTTO TRAMITE IL PROPRIO ID
    public function getProductById(int $prodId)
    {
        return Prodotto::find($prodId);
    }

    //-----------------------------------//

    //ESTRAZIONE TECNICI ORDINATI PER ID E PAGINATI A 5 ELEMENTI
    public function getPagedTechnics(): LengthAwarePaginator
    {
        return Tecnico::with('users')->orderBy('id', 'asc')->paginate(5);
    }

    //ESTRAZIONE TECNICO TRAMITE IL PROPRIO ID
    public function getTechnicsById(int $technicId)
    {
        return Tecnico::find($technicId);
    }

    //-----------------------------------//

    //ESTRAZIONE STAFF ORDINATI PER ID E PAGINATI A 5 ELEMENTI
    public function getPagedStaff(): LengthAwarePaginator
    {
        return Staff::with('users')->orderBy('id', 'asc')->paginate(5);
    }

    //ESTRAZIONE STAFF TRAMITE IL PROPRIO ID
    public function getStaffById(int $staffId)
    {
        return Staff::find($staffId);
    }

    //-----------------------------------//

    //ESTRAZIONE STAFF ORDINATI PER ID E PAGINATI A 5 ELEMENTI
    public function getPagedCenters(): LengthAwarePaginator
    {
        return CentroAssistenza::orderBy('id', 'asc')->paginate(5);
    }

    //ESTRAZIONE STAFF TRAMITE IL PROPRIO ID
    public function getCentersById(int $centerId)
    {
        return CentroAssistenza::find($centerId);
    }

}
