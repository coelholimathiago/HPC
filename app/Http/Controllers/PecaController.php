<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Models\MateriaPrima as MP;
use App\Models\Maquinas as Maquinas;
use App\Models\CentroCusto as CentroCusto;
use App\Models\Pecas as Pecas;
use App\Models\TemposPecas as TemposPecas;
use App\Models\PecaModelo as PecaModelo;

class PecaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $pecasModelo = PecaModelo::all();
      $listaPecas = Pecas::all();
      $pecasModelo = $pecasModelo->keyBy('idpeca');
      return view('pecas',compact('listaPecas','pecasModelo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $materiaPrima = new MP;
      $listaCentros = CentroCusto::all();
      $listaMP = $materiaPrima->all();
      return view('cadastros.peca',compact('listaMP','listaCentros'));
    }

    public function createByModel($id)
    {
      $pecas = Pecas::find($id);
      $idModelo = PecaModelo::where('idpeca',$id)->first();
      if(count($idModelo->copias) > 0)
      {
        $ultimoCodigo = $pecas->where('idmodelo',$idModelo->id)->orderBy('created_at','desc')->first()->codigo;
        $proximoCodigo = explode('-',$ultimoCodigo);
        $proximoCodigo = explode('.',$proximoCodigo[1]);
        $codigoCopia = $pecas->codigo."-1.".($proximoCodigo[1] + 1);
      }
      else
      {
        $codigoCopia = $pecas->codigo."-"."1.1";
      }
      $pecaCopia = $pecas->replicate();
      $pecaCopia->codigo = $codigoCopia;
      $pecaCopia->idmodelo = $idModelo->id;
      $pecaCopia->modelo = "NÃO";
      $pecaCopia->save();
      foreach ($pecas->tempos as $tempo)
      {
        $temposCopia = $tempo->replicate();
        $temposCopia->codigo = $codigoCopia;
        $temposCopia->idpeca = $pecaCopia->id;
        $temposCopia->save();
      }
      return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $pecas = new Pecas;
      $pecas->codigo = $request->codigo;
      $pecas->descricao = $request->descricao;
      $pecas->idmateriaprima = $request->materiaprima;
      if($request->modelo == 'on')
      {
        $modelo = new PecaModelo;
        $pecas->modelo = "SIM";
      }
      try
      {
        $pecas->save();
        if($pecas->modelo == 'SIM')
        {
          $modelo->idpeca = $pecas->id;
          $modelo->save();
        }
      }
      catch (Exception $e)
      {
        dd($e);
      }
      return redirect()->route('peca.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $infoPeca = Pecas::find($id);
      return view('showPeca',compact('infoPeca','tempos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $infoPeca = Pecas::find($id);
      $material = $infoPeca->materiaPrima->material;
      $listaMP = MP::all();
      return view('cadastros.peca',compact('infoPeca','material','listaMP'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $infoPeca = Pecas::find($id);
      $infoPeca->codigo = $request->codigo;
      $infoPeca->descricao = $request->descricao;
      $infoPeca->idmateriaprima = $request->materiaprima;
      if($request->modelo == 'on' && $infoPeca->modelo =="NÃO")
      {
        $infoPeca->modelo = "SIM";
        $salvarModelo = true;
        $excluirModelo = false;
      }
      else
      {
        if($infoPeca->modelo == "SIM")
        {
          $infoPeca->modelo = "NÃO";
          $salvarModelo = false;
          $excluirModelo = true;
        }
      }
      if($infoPeca->save())
      {
        if(isset($salvarModelo) && $salvarModelo == true)
        {
          $modelo = new PecaModelo;
          $modelo->idpeca = $id;
          $modelo->save();
        }
        if(isset($excluirModelo) && $excluirModelo == true)
        {
          $modelo = new PecaModelo;
          $modelo = $modelo->where('idpeca',$id)->delete();
        }
        return redirect()->route('peca.index');
      }
      else
      {
        return "Falha ao atualizar descricao";
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $pecas = new Pecas;
      $temposPecas = new TemposPecas;
      $infoPeca = $pecas->find($id);
      $temposPecas->where('codigo',$infoPeca->codigo)->delete();
      $pecas->destroy($id);
      return redirect()->route('peca.index');
    }

}
