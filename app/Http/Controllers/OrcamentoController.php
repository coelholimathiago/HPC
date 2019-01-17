<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Projetos as Projetos;
use DB;

class OrcamentoController extends Controller
{
  public function index($id)
  {
    $pecas = Projetos::find(1)->pecas();
    $custoBase = $pecas->sum('custoestimado');
    $tempoBase = $pecas->select(DB::raw('time_to_sec(tempoestimado) as sectempoestimado'))->get()->sum('sectempoestimado');
    return view('cadastros.orcamento',compact('id','custoBase','tempoBase'));
  }
}
