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
      $titulo = "PROJETOS ABERTOS";
      $resumoProjetos = $projetos
                        ->join('clientes','projetos.idcliente','=','clientes.id')
                        ->select('projetos.*','clientes.cliente')
                        ->where('status', 'aberto')
                        ->orderBy('projetos.dataprevista','asc')
                        ->get();
      return view('projetos',compact('resumoProjetos','titulo'));
    }

    public function projetosFechados()
    {
      $projetos = new Projetos;
      $titulo = "PROJETOS FECHADOS";
      $resumoProjetos = $projetos
                        ->join('clientes','projetos.idcliente','=','clientes.id')
                        ->select('projetos.*','clientes.cliente')
                        ->where('status', 'fechado')
                        ->orderBy('projetos.dataprevista','asc')
                        ->get();
      return view('projetos',compact('resumoProjetos','titulo'));
    }

    public function projetosAguardando()
    {
      $projetos = new Projetos;
      $titulo = "PROJETOS AGUARDANDO";
      $resumoProjetos = $projetos
                        ->join('clientes','projetos.idcliente','=','clientes.id')
                        ->select('projetos.*','clientes.cliente')
                        ->where('status', 'aguardando aprovação')
                        ->orderBy('projetos.dataprevista','asc')
                        ->get();
      return view('projetos',compact('resumoProjetos','titulo'));
    }
}
