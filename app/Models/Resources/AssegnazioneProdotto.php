<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AssegnazioneProdotto extends Pivot
{
    protected $table = 'assegnazione_prodotto';
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'id_staff_associato',
        'id_prodotto'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'id_staff_associato', 'id');
    }

    public function prodotto()
    {
        return $this->belongsTo(Prodotto::class, 'id_prodotto', 'id');
    }
}
