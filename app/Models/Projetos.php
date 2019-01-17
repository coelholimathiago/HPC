<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projetos extends Model
{
    protected $table = 'projetos';

    public function pecas()
    {
      return $this->hasMany('App\Models\PecasProjetos','idprojeto');
    }

    public function orcamento()
    {
      return $this->hasOne('App\Models\Orcamentos','idprojeto');
    }
}
