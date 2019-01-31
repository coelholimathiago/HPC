<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Projetos as Projetos;
use App\Models\Pecas as Pecas;
use App\Models\PecasProjetos as PecasProjetos;
use App\Models\TemposPecas as TemposPecas;
use App\Models\Orcamentos as Orcamentos;
use App\Models\Rastreamento as Rastreamento;
use Illuminate\Support\MessageBag as Erros;
use DB;

class ProjetoController extends Controller
{
    public function index($id)
    {
      $projeto = new Projetos;
      $projeto = $projeto::find($id);
      $pecas = new Pecas;
      $listaPecas = $pecas->all();
      $orcamento = new Orcamentos;
      $custos = $orcamento->where('idprojeto',$id)->first();
      return view('showProjeto',compact('projeto','listaPecas','custos','tempoGasto'));
    }

    public function adicionarPeca(Request $request)
    {
      $pecas = new Pecas;
      $infoPeca = $pecas->where('codigo',$request->peca)->first();
      $tempoEstimado = $infoPeca->tempos()->select(DB::raw('sum(time_to_sec(tempoestimado)) as tempoestimadopeca'))->first();
      $custoEstimado = $infoPeca->tempos()->sum('custoestimado');
      $pecaProjeto = new PecasProjetos;
      $verifProj = $pecaProjeto->where([
                  ['idprojeto','=',$request->projeto],
                  ['idpeca','=',$infoPeca->id],
                  ])->count();
      if($verifProj == 0)
      {
        $pecaProjeto->idprojeto = $request->projeto;
        $pecaProjeto->idpeca = $infoPeca->id;
        $pecaProjeto->idmateriaprima = $infoPeca->idmateriaprima;
        $pecaProjeto->quantidade = $request->quantidade;
        $pecaProjeto->tempoestimado = gmdate("H:i:s",$tempoEstimado->tempoestimadopeca * $request->quantidade);
        $pecaProjeto->custoestimado = $custoEstimado * $request->quantidade;
        try
        {
          $pecaProjeto->save();
          return back();
        }
        catch (Exception $e)
        {
          dd($e);
        }
      }
      else
      {
        $errors = new Erros;

        // add your error messages:
        $errors->add('peca_repetida', 'Esta peça já foi adicionada, exclua e altere a quantidade!');

        return back()->withErrors($errors);
      }
    }

    public function removerPeca(Request $request)
    {
      $pecaProjeto = new PecasProjetos;
      $pecaProjeto->destroy($request->remover);
      return back();
    }

    public function calcularOrcamento($id)
    {
      $pecaProjeto = new PecasProjetos;
      $infoProjeto = $pecaProjeto
                    ->select('pecasprojetos.*',DB::raw('time_to_sec(tempoestimado) as tempoestimadosec'))
                    ->where('idprojeto',$id)
                    ->get();
      $custoEstimado = $infoProjeto->sum('custoestimado');
      $tempoEstimado = $infoProjeto->sum('tempoestimadosec');
      return view('cadastros.orcamento',compact('custoEstimado','tempoEstimado','id'));
    }
    /**
    * Composição do código de barras
    * ID OPERACAO.ID PROJETO.CODIGO DA PEÇA.ID UNICO DA PEÇA.ID TEMPOS.ID MAQUINA.ID MATERIA PRIMA
    *
    */
    public function gerarBarcode($id)
    {
      $pecasProjeto = new PecasProjetos;
      $pecasProjeto = $pecasProjeto::find($id);
      return view('showBarcode',compact('pecasProjeto'));
    }

    public function finalizar($id)
    {
      $projeto = Projetos::find($id);
      $projeto->status = "fechado";
      $projeto->save();
      return redirect()->route('home');
    }

    public function reiniciar($id)
    {
      $projeto = Projetos::find($id);
      $projeto->status = "aberto";
      $projeto->save();
      return redirect()->route('home');
    }
}
