<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rastreamento extends Model
{
    protected $table = 'rastreamento';

    public function pecaProjeto()
    {
      return $this->belongsTo('App\Models\PecasProjetos','idpecaprojeto','id');
    }
}
