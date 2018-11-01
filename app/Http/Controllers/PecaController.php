<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\MateriaPrima as MP;
use App\Models\Maquinas as Maquinas;
use App\Models\Pecas as Pecas;

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
      $listaPecas = $pecas->all();
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
      $pecas->idmaquina = $request->maquina;
      $pecas->tempoestimado = $request->tempoestimado;
      try
      {
        $pecas->save();
        return redirect()->route('peca.index');
      }
      catch (Exception $e)
      {
        dd($e);
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
