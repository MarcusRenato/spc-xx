<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patrimony extends Model
{
    protected $fillable = [
        'rp', 'descricao', 'tipo_origem',
        'situacao', 'marca', 'location_id',
        'n_nf_tm', 'data_emissao', 'serie',
        'prd', 'processo', 'data_entrada',
        'origin_id', 'estado', 'situacao'
    ];

    public function localizacao()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
