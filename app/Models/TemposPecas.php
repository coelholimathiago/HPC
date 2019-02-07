<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemposPecas extends Model
{
    protected $table = 'tempospecas';

    public function centroCusto()
    {
      return $this->belongsTo('App\Models\CentroCusto','idcentrocusto','id');
    }
}
