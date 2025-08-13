<?php

namespace App\Models\Resources;

Use App\Models\User;
use App\Models\Resources\CentroAssistenza;
use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    protected $table = 'tecnico_assistenza';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'id_utente',
        'data_nascita',
        'id_centro_assistenza'
    ];

    public function utente()
    {
        return $this->belongsTo(User::class, 'id_utente', 'id');
    }

    public function centro()
    {
        return $this->belongsTo(CentroAssistenza::class, 'id_centro_assistenza', 'id');
    }
}
