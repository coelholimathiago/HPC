<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PecasProjetos extends Model
{
  protected $table = 'pecasprojetos';

  public function projeto()
  {
    return $this->belongsTo('App\Models\Projetos','idprojeto','id');
  }

  public function peca()
  {
    return $this->belongsTo('App\Models\Pecas','idpeca','id');
  }

  public function materiaPrima()
  {
    return $this->belongsTo('App\Models\MateriaPrima','idmateriaprima','id');
  }

  public function rastreamento()
  {
    return $this->hasMany('App\Models\Rastreamento','idpecaprojeto');
  }
}
