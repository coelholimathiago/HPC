<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';

    public $rules = [
      'cliente' => 'required',
    ];

    public $messages = [
      'cliente.required' => 'O Campo de cliente precisa ser preenchido',
    ];
}
