<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\MateriaPrima as MateriaPrima;

class MateriaPrimaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $listaMP = MateriaPrima::all()->sortBy('material');
      return view('materiaprima.main',compact('listaMP'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('materiaprima.novo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $materiaPrima = new MateriaPrima;
      $materiaPrima->material = $request->material;
      $materiaPrima->save();
      return redirect()->route('cadastro.materiaprima.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $infoMP = MateriaPrima::find($id);
      return view('materiaprima.show',compact('infoMP'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $infoMP = MateriaPrima::find($id);
      return view('materiaprima.novo',compact('infoMP'));
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
      $infoMP = MateriaPrima::find($id);
      $infoMP->material = $request->material;
      $infoMP->save();
      return redirect()->route('cadastro.materiaprima.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $infoPeca = MateriaPrima::destroy($id);
      return redirect()->route('cadastro.materiaprima.index');
    }
}
