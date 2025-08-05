<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentroAssistenza extends Model
{
    protected $table = 'centro_assistenza';
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'nome',
        'indirizzo',
        'foto'
    ];

    public function tecnico()
    {
        
    }
}
