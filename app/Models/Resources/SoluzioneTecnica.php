<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class SoluzioneTecnica extends Model
{
    protected $table = 'soluzione_tecnica';
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'descrizione',
        'tipologia_malfunzionamento',
        'id_prodotto'
    ];

    public function prodotto()
    {
        return $this->belongsTo(Prodotto::class, 'id', 'id_prodotto');
    }
}
