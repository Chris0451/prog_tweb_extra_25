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

    public function getPagedAssignedProds(): LengthAwarePaginator{
        return $this->prodotti()
                    ->select('prodotto.id', 'prodotto.nome')
                    ->orderBy('prodotto.id', 'asc')
                    ->paginate(5, ['*'], 'prod_page');
    }

    public function getPagedProdsWithMalfs(): LengthAwarePaginator{
        return $this->prodotti()
                    ->with('malfunzionamento:id,id_prodotto,tipologia,descrizione')
                    ->orderBy('prodotto.id', 'asc')
                    ->paginate(5, ['*'], 'prod_page');
    }

    public function getPagedAssignedMalfunctions(int $prodId): LengthAwarePaginator{
        return Malfunzionamento::where('id_prodotto', $prodId)
                ->orderBy('id', 'asc')
                ->paginate(5, ['*'], "malf_page_{$prodId}");
    }

    public function getMalfunctionById(int $malfId)
    {
        return Malfunzionamento::find($malfId);
    }

    //-----------------------------------//

    public function getPagedAssignedSolutions(int $malfId): LengthAwarePaginator
    {
        return SoluzioneTecnica::where('id_malfunzionamento', $malfId)
                ->orderBy('id', 'asc')
                ->paginate(5, ['*'], "sol_page_{$malfId}");
    }

    public function getSolutionById(int $solId)
    {
        return SoluzioneTecnica::find($solId);
    }
    
}
