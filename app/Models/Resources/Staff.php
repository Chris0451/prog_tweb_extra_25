<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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

    
}
