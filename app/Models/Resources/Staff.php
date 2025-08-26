<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class Staff extends Model
{
    protected $table = 'staff_tecnico';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'id_utente'
    ];

    public function utente()
    {
        return $this->belongsTo(User::class, 'id_utente', 'id');
    }

    public function prodotti()
    {
        return $this->belongsToMany(Prodotto::class, 'assegnazione_prodotto', 'id_staff_associato', 'id_prodotto')->using(AssegnazioneProdotto::class);
    }

    //-----------------------------------//

    public function getPagedAssignedMalfunctions(){
        return $this->prodotti()->with(['malfunzionamento', 'staff'])->orderBy('prodotto.id', 'asc')->paginate(3);
    }

    public function getMalfunctionById(int $malfId)
    {
        return Malfunzionamento::find($malfId);
    }

    //-----------------------------------//

    public function getPagedAssignedSolutions(): LengthAwarePaginator
    {
        return $this->prodotti()->with(['malfunzionamento.soluzione_tecnica', 'staff'])->orderBy('prodotto.id', 'asc')->paginate(3);
    }

    public function getSolutionById(int $solId)
    {
        return SoluzioneTecnica::find($solId);
    }
    
}
