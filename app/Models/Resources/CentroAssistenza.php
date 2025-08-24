<?php

namespace App\Models\Resources;

use App\Models\Resources\Tecnico;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CentroAssistenza extends Model
{
    protected $table = 'centro_assistenza';
    public $timestamps = false;
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

    public function getFotoUrlAttribute()
    {
        if ($this->foto && Storage::disk('public')->exists('images/assistance_centers/'.$this->foto)) {
            return asset('storage/images/assistance_centers/'.$this->foto);
        }

        return asset('images/placeholder.jpg');
    }

}
