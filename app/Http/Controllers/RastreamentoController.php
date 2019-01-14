<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Rastreamento as Rastreamento;
use DB;

class RastreamentoController extends Controller
{
    public function index()
    {
      return view('rastreamento.main');
    }

    public function busca(Request $request)
    {
      $log = new Rastreamento;
      $funcionario = $request->codigoFuncionario;
      $busca = $log->where('funcionario',$funcionario)->get();
      return view('rastreamento.menuIniciar',compact('funcionario'));
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
    }
}
