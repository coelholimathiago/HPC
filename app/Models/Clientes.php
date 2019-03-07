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
      'cliente.required' => 'O CAMPO "NOME DO CLIENTE" É OBRIGATÓRIO!',
      'cliente.unique' => 'JÁ EXISTE UM CLIENTE CADASTRADO COM ESSE NOME!',
      'email.email' => 'INSIRA UM EMAIL VÁLIDO!',
      'cnpj.required' => 'O CAMPO "CNPJ" É OBRIGATÓRIO!',
      'cnpj.unique' => 'JÁ EXISTE UM CLIENTE COM ESTE CNPJ CADASTRADO!',
    ];
}
