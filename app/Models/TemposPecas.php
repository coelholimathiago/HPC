<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemposPecas extends Model
{
    protected $table = 'tempospecas';

    public function maquina()
    {
      return $this->belongsTo('App\Models\Maquinas','idmaquina','id');
    }
}
