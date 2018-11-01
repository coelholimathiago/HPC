<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Projetos as Projetos;
use App\Models\Pecas as Pecas;

class ProjetoController extends Controller
{
    public function index($id)
    {
      $projeto = new Projetos;
      $pecas = new Pecas;
      $infoProjeto = $projeto->find($id);
      $listaPecas = $pecas->all();
      return view('showProjeto',compact('infoProjeto','listaPecas'));
    }

    public function adicionarPeca(Request $request)
    {
      dd($request->all());
    }
}
