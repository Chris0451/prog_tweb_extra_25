<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\ForeignKeyDefinition;

class Malfunzionamento extends Model
{
    protected $table = 'malfunzionamento';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'tipologia',
        'descrizione',
        'id_prodotto'
    ];

    public function prodotto()
    {
        return $this->belongsTo(Prodotto::class, 'id_prodotto', 'id');
    }

    public function soluzione_tecnica()
    {
        return $this->hasMany(SoluzioneTecnica::class, 'id_malfunzionamento', 'id');
    }
}
