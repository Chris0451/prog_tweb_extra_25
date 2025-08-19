<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Prodotto extends Model
{
    protected $table = 'prodotto';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'descrizione',
        'tecniche_uso',
        'mod_installazione',
        'modello',
        'marca',
        'foto'
    ];

    public function malfunzionamento()
    {
        return $this->hasMany(Malfunzionamento::class, 'id_prodotto', 'id');
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'assegnazione_prodotto', 'id_prodotto', 'id_staff_associato');
    }
}
