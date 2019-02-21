<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemposPecas extends Model
{
    protected $table = 'tempospecas';

    protected $fillable = ['codigo','idpeca','idcentrocusto','descricao','tempoestimado'];

    public function centroCusto()
    {
      return $this->belongsTo('App\Models\CentroCusto','idcentrocusto','id');
    }
}
