<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Funcionarios as Funcionarios;

class FuncionarioController extends Controller
{

    private $funcionarios;

    public function __construct()
    {
      $this->funcionarios = new Funcionarios;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $funcionarios = $this->funcionarios->all();
      return view('funcionarios',compact('funcionarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('cadastros.funcionario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->funcionarios->nome = $request->nome;
      $this->funcionarios->cargo = $request->cargo;
      $this->funcionarios->ativo = ($request->ativo == 'on') ? 1 : 0;
      $this->funcionarios->custohora = str_replace(",",".",$request->custohora);
      $this->funcionarios->save();
      return redirect()->route('cadastro.funcionario.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $dadosFuncionario = $this->funcionarios->find($id);
      return view('showFuncionario',compact('dadosFuncionario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $dadosFuncionario = $this->funcionarios->find($id);
      return view('cadastros.funcionario',compact('dadosFuncionario'));
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
      $dadosFuncionario = $this->funcionarios->find($id);
      $dadosFuncionario->nome = $request->nome;
      $dadosFuncionario->cargo = $request->cargo;
      $dadosFuncionario->ativo = ($request->ativo == 'on') ? 1 : 0;
      $dadosFuncionario->custohora = $request->custohora;
      $dadosFuncionario->save();
      return redirect()->route('cadastro.funcionario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if($this->funcionarios->destroy($id))
      {
        return redirect()->route('cadastro.funcionario.index');
      }
      else
      {
        return "Falha ao deletar funcionário";
      }
    }
}
