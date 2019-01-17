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
use DB;

class ProjetoController extends Controller
{
    public function index($id)
    {
      $projeto = new Projetos;
      $pecas = new Pecas;
      $pecasProjeto = new PecasProjetos;
      $orcamento = new Orcamentos;
      $log = new Rastreamento;
      $infoProjeto = $projeto->find($id);
      $listaPecas = $pecas->all();
      $custos = $orcamento->where('idprojeto',$id)->first();
      $listaPecasProjeto = $pecasProjeto
                          ->join('pecas','pecasprojetos.idpeca','=','pecas.id')
                          ->join('materiaprima','pecasprojetos.idmateriaprima','=','materiaprima.id')
                          ->select('pecasprojetos.*',DB::raw('time_to_sec(pecasprojetos.tempoestimado) as sectempoestimado'),'pecas.codigo','materiaprima.material')
                          ->where('idprojeto',$id)->get();
      $tempoGasto = $log
                    ->where('idprojeto',$id)
                    ->groupBy('idpeca')
                    ->select('idpeca','funcionario',DB::raw('sec_to_time(sum(time_to_sec(tempogasto))) as tempogasto'),DB::raw('sum(time_to_sec(tempogasto)) as sectempogasto'),'status')
                    ->get();
      return view('showProjeto',compact('infoProjeto','listaPecas','listaPecasProjeto','custos','tempoGasto'));
    }

    public function adicionarPeca(Request $request)
    {
      $pecas = new Pecas;
      $infoPeca = $pecas
                  ->join('materiaprima','pecas.idmateriaprima','=','materiaprima.id')
                  ->select('pecas.*','materiaprima.material')
                  ->where('codigo',$request->peca)
                  ->first();
      $tempos = new TemposPecas;
      $listaTempos = $tempos
                    ->join('maquinas','tempospecas.idmaquina','=','maquinas.id')
                    ->where('codigo',$infoPeca->codigo)
                    ->select('tempospecas.codigo',DB::raw('sum(time_to_sec(tempospecas.tempoestimado)*maquinas.custohora/3600) as custototal,sec_to_time(sum(time_to_sec(tempospecas.tempoestimado))) as tempototal'))
                    ->first();
      $pecaProjeto = new PecasProjetos;
      $pecaProjeto->idprojeto = $request->projeto;
      $pecaProjeto->idpeca = $infoPeca->id;
      $pecaProjeto->idmateriaprima = $infoPeca->idmateriaprima;
      $pecaProjeto->tempoestimado = $listaTempos->tempototal;
      $pecaProjeto->custoestimado = $listaTempos->custototal;
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
    * ID PROJETO.CODIGO DA PEÇA.ID UNICO DA PEÇA.ID TEMPOS.ID MAQUINA.ID MATERIA PRIMA
    *
    */
    public function gerarBarcode($id)
    {
      $pecaProjeto = new PecasProjetos;
      $info = $pecaProjeto
              ->join('pecas','pecasprojetos.idpeca','=','pecas.id')
              ->join('tempospecas','pecas.codigo','=','tempospecas.codigo')
              ->join('maquinas','tempospecas.idmaquina','=','maquinas.id')
              ->where('pecasprojetos.id',$id)
              ->select('pecasprojetos.idprojeto','pecas.id','pecas.codigo','pecas.idmateriaprima','tempospecas.id as idtempo','tempospecas.descricao','tempospecas.tempoestimado','maquinas.id as idmaquina','maquinas.descricao as tipomaquina')
              ->get();
      return view('showBarcode',compact('info'));
    }
}
