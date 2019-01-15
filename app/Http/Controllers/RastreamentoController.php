<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Rastreamento as Rastreamento;
use App\Models\Funcionarios as Funcionarios;
use DB;

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
        $log = new Rastreamento;
        $funcionario = $request->codigoFuncionario;
        $busca = $log
                ->join('projetos','rastreamento.idprojeto','=','projetos.id')
                ->join('pecas','rastreamento.idpeca','=','pecas.id')
                ->join('funcionarios','rastreamento.funcionario','=','funcionarios.id')
                ->where([
                ['rastreamento.funcionario',$funcionario],
                ['rastreamento.status','!=','FINALIZADO'],
                ])->select('rastreamento.id','funcionarios.nome as func','projetos.nome as projeto','pecas.codigo','rastreamento.status','rastreamento.updated_at as horainicial')
                ->get();
        if(in_array("EM ANDAMENTO",array_column($busca->toArray(),'status')))
        {
          return view('rastreamento.menuFinalizar',compact('busca'));
        }
        else
        {
          return view('rastreamento.menuIniciar',compact('buscaFuncionario','busca'));
        }
      }
      else
      {
        return redirect('rastreamento')->with('erro', 'funcionario');
      }
    }

    public function iniciar(Request $request)
    {
      $barcode = explode(".",$request->barcode);
      $idprojeto = $barcode[0];
      $codigoPeca = $barcode[1];
      $idpeca = $barcode[2];
      $idtempos = $barcode[3];
      $idmaquina = $barcode[4];
      $idMp = $barcode[5];
      $log = new Rastreamento;
      $log->idprojeto = $idprojeto;
      $log->idpeca = $idpeca;
      $log->idtempos = $idtempos;
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
        $registro->status = 'FINALIZADO';
        $registro->save();
        return redirect('rastreamento');
      }
      else
      {
        if($request->button == 'pausar')
        {
          $registro = $log->find($request->id);
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
