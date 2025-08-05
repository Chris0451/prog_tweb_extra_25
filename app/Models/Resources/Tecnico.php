<?php

namespace App\Models;

use App\Models\Resources\CentroAssistenza;
use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    protected $table = 'tecnico_assistenza';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $keyType = 'unsignedBigInteger';

    protected $fillable = [
        'id_utente',
        'data_nascita',
        'id_centro_assistenza'
    ];

    public function utente()
    {
        return $this->belongsTo(User::class, 'id_utente');
    }

    public function centro_assistenza()
    {
        return $this->hasOne(CentroAssistenza::class, 'id_centro_assistenza');
    }
}
