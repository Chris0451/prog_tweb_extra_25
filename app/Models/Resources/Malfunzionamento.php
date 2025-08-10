<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\ForeignKeyDefinition;

class Malfunzionamento extends Model
{
    protected $table = 'malfunzionamento';
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'descrizione',
        'tipologia',
        'id_prodotto'
    ];

    public function prodotto()
    {
        return $this->belongsTo(Prodotto::class, 'id_prodotto', 'id');
    }

    public function soluzione()
    {
        return $this->hasMany(SoluzioneTecnica::class, 'tipologia_malfunzionamento', 'tipologia');
    }
}
