<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Rastreamento as Rastreamento;
use App\Models\Funcionarios as Funcionarios;
use DB;
use Validator;
use Illuminate\Support\MessageBag as Erros;

class RastreamentoController extends Controller
{
    public function index()
    {
      return view('rastreamento.main');
    }

    public function busca(Request $request)
    {
      $funcionarios = new Funcionarios;
      $buscaFuncionario = $funcionarios->find($request->codigoFuncionario);
      if($buscaFuncionario != null)
      {
        if(count($buscaFuncionario->registros->where('status','EM ANDAMENTO')) > 0)
        {
          return view('rastreamento.menuFinalizar',compact('buscaFuncionario'));
        }
        else
        {
          return view('rastreamento.menuIniciar',compact('buscaFuncionario'));
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
      $idpecaprojeto = $barcode[0];
      $log = new Rastreamento;
      $log->idpecaprojeto = $idpecaprojeto;
      $log->funcionario = $request->funcionario;
      $log->status = "EM ANDAMENTO";
      $log->save();
      return redirect('rastreamento');
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
