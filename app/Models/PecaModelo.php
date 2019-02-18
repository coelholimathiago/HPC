<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PecaModelo extends Model
{
  protected $table = 'pecamodelo';

  public function copias()
  {
    return $this->hasMany('App\Models\Pecas','idmodelo');
  }

}
