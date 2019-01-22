<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionarios extends Model
{
    protected $table = 'funcionarios';
    protected $fillable = ['nome','cargo','ativo','custohora'];

    public function registros()
    {
      return $this->hasMany('App\Models\Rastreamento','funcionario');
    }
}
