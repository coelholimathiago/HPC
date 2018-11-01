<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Maquinas as Maquinas;

class MaquinasController extends Controller
{
    private $maquinas;

    public function __construct()
    {
      $this->maquinas = new Maquinas;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $listaMaquinas = $this->maquinas->all();
      return view('maquinas',compact('listaMaquinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('cadastros.maquina');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->maquinas->descricao = $request->descricao;
      $this->maquinas->modelo = $request->modelo;
      $this->maquinas->fabricante = $request->fabricante;
      $this->maquinas->ano = $request->ano;
      $this->maquinas->preco = $request->preco;
      $this->maquinas->custohora = $request->custohora;
      try {
        $this->maquinas->save();
        return redirect()->route('cadastro.maquina.index');
      } catch (\Illuminate\Database\QueryException $e) {
          dd($e);
      } catch (\Exception $e) {
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
      $infoMaquina = $this->maquinas->find($id);
      return view('showMaquina',compact('infoMaquina'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $infoMaquinas = $this->maquinas->find($id);
      return view('cadastros.maquina',compact('infoMaquinas'));
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
      $infoMaquina = $this->maquinas->find($id);
      $infoMaquina->descricao = $request->descricao;
      $infoMaquina->modelo = $request->modelo;
      $infoMaquina->fabricante = $request->fabricante;
      $infoMaquina->ano = $request->ano;
      $infoMaquina->preco = $request->preco;
      $infoMaquina->custohora = $request->custohora;
      try
      {
        $infoMaquina->save();
        return redirect()->route('cadastro.maquina.index');
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
      if($this->maquinas->destroy($id))
      {
        return redirect()->route('cadastro.maquina.index');
      }
      else
      {
        return "Falha ao excluir máquina";
      }
    }
}
