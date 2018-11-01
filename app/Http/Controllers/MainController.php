<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Projetos as Projetos;

class MainController extends Controller
{
    public function index()
    {
      return view('painel');
    }

    public function novoProjeto()
    {
      return view('novoprojeto');
    }

    public function projetosAbertos()
    {
      $projetos = new Projetos;
      $projetosAbertos = $projetos->join('clientes','projetos.idcliente','=','clientes.id')->select('projetos.*','clientes.cliente')->where('status', 'aberto')->get();
      return view('projetos',compact('projetosAbertos'));
    }

    public function projetosFechados()
    {
      return "Mostrar projetos fechados";
    }
}
