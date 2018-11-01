<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Projetos as Projetos;
use App\Models\Clientes as Clientes;

class NovoProjetoController extends Controller
{

    private $projetos;
    private $clientes;

    public function __construct()
    {
      $this->projetos = new Projetos;
      $this->clientes = new Clientes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $listaClientes = $this->clientes->all();
      return view('novoprojeto',compact('listaClientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->projetos->nome = $request->nome;
      $this->projetos->idcliente = $request->cliente;
      $this->projetos->status = $request->status;
      $this->projetos->dataprevista = $request->dataprevista;
      try
      {
        $this->projetos->save();
        return redirect()->route('home');
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
