<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\CentroCusto as CentroCusto;

class CentroCustoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $listaCentros = CentroCusto::all();
      $listaCentros = $listaCentros->sortBy('centro');
      return view('centrocusto',compact('listaCentros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('cadastros.centrocusto');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $centroCusto = new CentroCusto;
      $centroCusto->centro = $request->centroCusto;
      $centroCusto->custohora = $request->custoHora;
      $centroCusto->save();
      return redirect()->route('cadastro.centrocusto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $infoCentro = CentroCusto::find($id);
      return view('showCentroCusto',compact('infoCentro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $infoCentro = CentroCusto::find($id);
      return view('cadastros.centrocusto',compact('infoCentro'));
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
      $centroCusto = CentroCusto::find($id);
      $centroCusto->centro = $request->centroCusto;
      $centroCusto->custohora = $request->custoHora;
      try
      {
        $centroCusto->save();
        return redirect()->route('cadastro.centrocusto.index');
      }
      catch (Exception $e)
      {
        dd($e);
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
      if(CentroCusto::destroy($id))
      {
        return redirect()->route('cadastro.centrocusto.index');
      }
      else
      {
        return "Falha ao apagar centro de custo!";
      }
    }
}
