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
        return $this->belongsToMany(Prodotto::class, 'assegnazione_prodotto', 'id_staff_associato', 'id_prodotto');
    }

    //-----------------------------------//

    public function getPagedMalfunctions(): LengthAwarePaginator
    {
        return Malfunzionamento::orderBy('id','asc')->paginate(5);
    }

    public function getMalfunctionById(int $malfId)
    {
        return Malfunzionamento::find($malfId);
    }

    //-----------------------------------//

    public function getPagedSolutions(): LengthAwarePaginator
    {
        return SoluzioneTecnica::orderBy('id','asc')->paginate(5);
    }

    public function getSolutionsById(int $solId)
    {
        return SoluzioneTecnica::find($solId);
    }
}
