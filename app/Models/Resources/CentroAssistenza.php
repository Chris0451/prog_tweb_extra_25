<?php

namespace App\Models\Resources;

use App\Models\Resources\Tecnico;
use Illuminate\Database\Eloquent\Model;

class CentroAssistenza extends Model
{
    protected $table = 'centro_assistenza';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'nome',
        'indirizzo',
        'foto'
    ];

    public function tecnico()
    {
        return $this->hasMany(Tecnico::class, 'id_centro_assistenza', 'id');
    }
}
