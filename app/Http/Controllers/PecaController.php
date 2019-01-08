<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Models\MateriaPrima as MP;
use App\Models\Maquinas as Maquinas;
use App\Models\Pecas as Pecas;
use App\Models\TemposPecas as TemposPecas;
use Picqer\Barcode\BarcodeGeneratorHTML as BC;

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
      $maquinas = new Maquinas;
      $listaMP = $materiaPrima->all();
      $listaMaquinas = $maquinas->all();
      return view('cadastros.peca',compact('listaMP','listaMaquinas'));
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
      try
      {
        $pecas->save();
      }
      catch (Exception $e)
      {
        dd($e);
      }
      for ($i=0; $i < $request->qtdMaquinas ; $i++)
      {
        $temposPecas = new TemposPecas;
        $temposPecas->codigo = $request->codigo;
        $temposPecas->idmaquina = $request->maquina[$i];
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
      $pecas = new Pecas;
      $temposPecas = new TemposPecas;
      $infoPeca = $pecas
                  ->join('materiaprima','pecas.idmateriaprima','=','materiaprima.id')
                  ->select('pecas.*','materiaprima.material')
                  ->where('pecas.id',$id)
                  ->first();
      $tempos = $temposPecas
                ->join('maquinas','tempospecas.idmaquina','=','maquinas.id')
                ->where('tempospecas.codigo',$infoPeca->codigo)
                ->select('tempospecas.*','maquinas.descricao','maquinas.custohora',DB::raw('time_to_sec(tempospecas.tempoestimado)*maquinas.custohora/3600 as custo'))
                ->get();
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
      $pecas = new Pecas;
      $temposPecas = new TemposPecas;
      $materiaPrima = new MP;
      $maquinas = new Maquinas;
      $infoPeca = $pecas->find($id);
      $tempos = $temposPecas
                ->join('maquinas','tempospecas.idmaquina','=','maquinas.id')
                ->select('tempospecas.*','maquinas.descricao')
                ->where('codigo',$infoPeca->codigo)->get();
      $material = $materiaPrima->where('id',$infoPeca->idmateriaprima)->get()->first();
      $listaMP = $materiaPrima->all();
      $listaMaquinas = $maquinas->all();
      return view('cadastros.peca',compact('infoPeca','tempos','material','listaMP','listaMaquinas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $codigo)
    {
      $pecas = new Pecas;
      $infoPeca = $pecas
                  ->where('codigo',$codigo)
                  ->update(['codigo' => $request->codigo,'descricao' => $request->descricao,'idmateriaprima' => $request->materiaprima]);
      if($request->qtdMaquinas != "")
      {
        $temposPecas = new TemposPecas;
        $temposPecas->where('codigo',$codigo)->delete();
        unset($temposPecas);
        for ($i=0; $i < $request->qtdMaquinas ; $i++)
        {
          $temposPecas = new TemposPecas;
          $temposPecas->codigo = $request->codigo;
          $temposPecas->idmaquina = $request->maquina[$i];
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
      }
      return redirect()->route('peca.index');
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
