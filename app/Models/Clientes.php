<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';

    public $rules = [
      'cliente' => 'required|unique:clientes',
      'email' => 'email',
      'cnpj' => 'required|unique:clientes',
    ];

    public $messages = [
      'cliente.required' => 'O Campo de cliente é obrigatório!',
      'cliente.unique' => 'Já existe um cliente cadastrado com esse nome!',
      'email.email' => 'Insira um email válido!',
      'cnpj.required' => 'O Campo CNPJ é obrigatório!',
      'cnpj.unique' => 'Já existe um cliente com este CNPJ cadastrado!',
    ];
}
