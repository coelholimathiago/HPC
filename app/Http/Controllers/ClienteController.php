<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Clientes as Clientes;

class ClienteController extends Controller
{
    private $clientes;

    public function __construct()
    {
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
      return view('clientes',compact('listaClientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('cadastros.cliente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,$this->clientes->rules,$this->clientes->messages);
      $this->clientes->cliente = $request->cliente;
      $this->clientes->endereco = $request->endereco;
      $this->clientes->telefone = $request->telefone;
      $this->clientes->email = $request->email;
      $this->clientes->cnpj = $request->cnpj;
      $this->clientes->inscricaoestadual = $request->inscricao;
      try {
        $this->clientes->save();
        return redirect()->route('cadastro.cliente.index');
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
      $infoCliente = $this->clientes->find($id);
      return view('showCliente',compact('infoCliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $infoCliente = $this->clientes->find($id);
      return view('cadastros.cliente',compact('infoCliente'));
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
      $infoCliente = $this->clientes->find($id);
      $infoCliente->cliente = $request->cliente;
      $infoCliente->endereco = $request->endereco;
      $infoCliente->telefone = $request->telefone;
      $infoCliente->email = $request->email;
      $infoCliente->cnpj = $request->cnpj;
      $infoCliente->inscricaoestadual = $request->inscricao;
      try
      {
        $infoCliente->save();
        return redirect()->route('cadastro.cliente.index');
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
      if($this->clientes->destroy($id))
      {
        return redirect()->route('cadastro.cliente.index');
      }
      else
      {
        return "Falha ao apagar cliente!";
      }
    }
}
