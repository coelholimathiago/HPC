<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Projetos as Projetos;
use App\Models\Orcamentos as Orcamentos;
use DB;

class OrcamentoController extends Controller
{
  public function index($id)
  {
    $orcamento = Projetos::find($id)->orcamento;
    $pecas = Projetos::find($id)->pecas();
    $custoBase = $pecas->sum('custoestimado');
    $tempoBase = $pecas->select(DB::raw('sec_to_time(sum(time_to_sec(tempoestimado))) as tempototalprojeto'),DB::raw('sum(time_to_sec(tempoestimado)) as sectempoestimado'))->first();
    if(count($orcamento) == 0)
    {
      return view('cadastros.orcamento',compact('id','custoBase','tempoBase'));
    }
    else
    {
      $materiaPrima = $orcamento->materiaprima;
      $custoTerceiros = $orcamento->custoterceiros;
      $transporte = $orcamento->custotransporte;
      $margemLucro = $orcamento->margem;
      return view('cadastros.orcamento',compact('id','custoBase','tempoBase','materiaPrima','custoTerceiros','transporte','margemLucro'));
    }
  }

  public function salvar(Request $request)
  {
    $orcamentoCadastrado = Projetos::find($request->id);
    if(count($orcamentoCadastrado->orcamento) == 0)
    {
      $orcamento = new Orcamentos;
    }
    else
    {
      $orcamento = $orcamentoCadastrado->orcamento;
    }
    $orcamento->idprojeto = $request->id;
    $orcamento->custoBase = $request->custoEstimado;
    $orcamento->basecustoindireto = $request->custoFixo;
    $orcamento->custoindireto = $request->custoIndireto;
    $orcamento->materiaprima = str_replace(",",".",$request->materiaPrima);
    $orcamento->custoterceiros = str_replace(",",".",$request->terceiros);
    $orcamento->custotransporte = str_replace(",",".",$request->transporte);
    $orcamento->margem = $request->margemLucro;
    $orcamento->custofinal = ($request->custoEstimado + $request->custoIndireto + $request->materiaPrima + $request->terceiros + $request->transporte)*($request->margemLucro/100 + 1);
    $orcamento->save();
    return redirect()->route('detalhesProjeto',['id' => $request->id]);
  }
}
