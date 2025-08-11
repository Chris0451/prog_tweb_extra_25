<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class SoluzioneTecnica extends Model
{
    protected $table = 'soluzione_tecnica';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'tipologia',
        'descrizione',
        'id_malfunzionamento'
    ];

    public function malfunzionamento()
    {
        return $this->belongsTo(Malfunzionamento::class, 'id_malfunzionamento', 'id');
    }
}
