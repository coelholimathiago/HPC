<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Pecas as Pecas;
use App\Models\CentroCusto as CentroCusto;
use App\Models\TemposPecas as TemposPecas;

class TemposController extends Controller
{
  public function index($id)
  {
    $infoPeca = Pecas::find($id);
    $tempos = $infoPeca->tempos;
    $listaCentros = CentroCusto::all();
    return view('tempos',compact('id','infoPeca','tempos','listaCentros'));
  }

  public function cadastrar(Request $request)
  {
    $infoPeca = Pecas::find($request->idpeca);
    for ($i=0; $i < count($request->centroCusto) ; $i++)
    {
      if($request->acao[$i] != "excluir")
      {
        if($request->acao[$i] != "editar")
        {
          $tempos = new TemposPecas;
          $tempos->codigo = $infoPeca->codigo;
          $tempos->idpeca = $request->idpeca;
          $tempos->idcentrocusto = $request->centroCusto[$i];
          $tempos->descricao = $request->descricao[$i];
          $tempos->tempoestimado = $request->tempoEstimado[$i];
          $tempos->save();
        }
        else
        {
          $tempos = TemposPecas::firstOrNew(['id' => $request->idregistro[$i]]);
          $tempos->codigo = $infoPeca->codigo;
          $tempos->idpeca = $request->idpeca;
          $tempos->idcentrocusto = $request->centroCusto[$i];
          $tempos->descricao = $request->descricao[$i];
          $tempos->tempoestimado = $request->tempoEstimado[$i];
          $tempos->save();
        }
      }
      else
      {
        $tempo = TemposPecas::find($request->idregistro[$i]);
        $tempo->delete();
      }
    }
    return redirect()->route('peca.index');
  }
}
