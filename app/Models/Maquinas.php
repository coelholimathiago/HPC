<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maquinas extends Model
{
  protected $table = 'maquinas';

  public function centroCusto()
  {
    return $this->belongsTo('App\Models\CentroCusto','idcentrocusto');
  }
}
