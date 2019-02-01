<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Projetos as Projetos;
use App\Models\Rastreamento as Rastreamento;
use App\Models\Funcionarios as Funcionarios;
use App\Models\Maquinas as Maquinas;
use App\Models\TemposPecas as Tempos;
use DB;
use Validator;
use Illuminate\Support\MessageBag as Erros;

class RastreamentoController extends Controller
{
    public function index()
    {
      $funcionarios = new Funcionarios;
      $funcionarios = $funcionarios
                      ->where('ativo',1)
                      ->orderBy('nome','asc')
                      ->get();
      return view('rastreamento.main',compact('funcionarios'));
    }

    public function busca(Request $request)
    {
      $funcionarios = new Funcionarios;
      $maquinas = Maquinas::all();
      $buscaFuncionario = $funcionarios->find($request->codigoFuncionario);
      if($buscaFuncionario != null)
      {
        if(count($buscaFuncionario->registros->where('status','EM ANDAMENTO')) > 0)
        {
          return view('rastreamento.menuFinalizar',compact('buscaFuncionario'));
        }
        else
        {
          return view('rastreamento.menuIniciar',compact('buscaFuncionario','maquinas'));
        }
      }
      else
      {
        return redirect('rastreamento');
      }
    }

    public function iniciar(Request $request)
    {
      $barcode = explode(".",$request->barcode);
      $idProjeto = $barcode[1];
      $infoProjeto = Projetos::find($idProjeto);
      if($infoProjeto->status == 'aberto')
      {
        $idpecaprojeto = $barcode[0];
        $pecasProjeto = $infoProjeto->pecas->find($idpecaprojeto);
        if(count($pecasProjeto) > 0)
        {
          $idtempospecas = $barcode[4];
          $tempos = Tempos::find($idtempospecas);
          if(count($tempos) > 0)
          {
            $log = new Rastreamento;
            $log->idpecaprojeto = $idpecaprojeto;
            $log->idtempospecas = $idtempospecas;
            $log->funcionario = $request->funcionario;
            $log->status = "EM ANDAMENTO";
            $log->save();
            return redirect('rastreamento');
          }
          else
          {
            return "Tempos não cadastrados!!";
          }
        }
        else
        {
          return "Peça não cadastrada no projeto!";
        }
      }
      else
      {
        return "Projeto Fechado!!";
      }
    }

    public function finalizar(Request $request)
    {
      $log = new Rastreamento;
      if($request->button == 'finalizar')
      {
        $registro = $log->find($request->id);
        $registro->qtdproduzida = $request->quantidade;
        $registro->status = 'FINALIZADO';
        $registro->save();
        return redirect('rastreamento');
      }
      else
      {
        if($request->button == 'pausar')
        {
          $registro = $log->find($request->id);
          $registro->qtdproduzida = $request->quantidade;
          $registro->status = 'PAUSADO';
          $registro->save();
          return redirect('rastreamento');
        }
      }
    }

    public function reiniciar(Request $request)
    {
      $log= new Rastreamento;
      $registro = $log->find($request->id);
      $registro->status = "EM ANDAMENTO";
      $registro->save();
      return redirect('rastreamento');
    }
}
