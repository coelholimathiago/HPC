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
      $pecas = new Pecas;
      $listaPecas = $pecas
                    ->join('materiaprima','pecas.idmateriaprima','=','materiaprima.id')
                    ->select('pecas.*','materiaprima.material')->get();
      $listaPecas = $listaPecas->sortBy('codigo');
      return view('pecas',compact('listaPecas'));
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
        $modelo->idpeca = $pecas->id;
        $modelo->save();
      }
      catch (Exception $e)
      {
        dd($e);
      }
      for ($i=0; $i < $request->qtdMaquinas ; $i++)
      {
        $temposPecas = new TemposPecas;
        $temposPecas->codigo = $request->codigo;
        $temposPecas->idpeca = $pecas->id;
        $temposPecas->idcentrocusto = $request->maquina[$i];
        $temposPecas->descricao = $request->operacao[$i];
        $temposPecas->tempoestimado = $request->tempoestimado[$i];
        try
        {
          $temposPecas->save();
        }
        catch (Exception $e)
        {
          dd($e);
        }
        unset($temposPecas);
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
      $tempos = $infoPeca->tempos;
      $listaMP = MP::all();
      $listaCentros = CentroCusto::all();
      return view('cadastros.peca',compact('infoPeca','tempos','material','listaMP','listaCentros'));
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
      if($request->modelo == 'on')
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
        if($salvarModelo == true)
        {
          $modelo = new PecaModelo;
          $modelo->idpeca = $id;
          $modelo->save();
        }
        if($excluirModelo == true)
        {
          $modelo = new PecaModelo;
          $modelo = $modelo->where('idpeca',$id)->delete();
        }
        $infoPeca->tempos()->delete();
        for ($i=0; $i < $request->qtdMaquinas ; $i++)
        {
          $temposPecas = new TemposPecas;
          $temposPecas->codigo = $request->codigo;
          $temposPecas->idpeca = $id;
          $temposPecas->idcentrocusto = $request->maquina[$i];
          $temposPecas->descricao = $request->operacao[$i];
          $temposPecas->tempoestimado = $request->tempoestimado[$i];
          try
          {
            $temposPecas->save();
          }
          catch (Exception $e)
          {
            dd($e);
          }
          unset($temposPecas);
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
