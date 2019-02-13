<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pecas extends Model
{
    protected $table = 'pecas';

    public function materiaPrima()
    {
      return $this->belongsTo('App\Models\MateriaPrima','idmateriaprima','id');
    }

    public function tempos()
    {
      return $this->hasMany('App\Models\TemposPecas','idpeca');
    }

}
