<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class AssegnazioneProdotto extends Model
{
    protected $table = 'assegnazione_prodotto';
    protected $primaryKey = null;
    public $incrementing = false;

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function prodotto()
    {
        return $this->belongsTo(Prodotto::class);
    }
}
