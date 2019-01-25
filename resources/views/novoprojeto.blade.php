@extends('layouts.forms')

@section('nome')
  NOVO PROJETO
@endsection

@section('dados')
  <form class="form-group" action="{{route('projetos.novo.store')}}" method="post">
    {!! csrf_field() !!}
    <div class="titulo">Título do projeto:</div>
    <input type="text" class="form-control" name="nome" required>
    <div class="titulo">Nome do cliente:</div>
    <select class="form-control" name="cliente">
      @foreach ($listaClientes as $clientes)
        <option value="{{$clientes->id}}">{{$clientes->cliente}}</option>
      @endforeach
    </select>
    <div class="titulo">Status do projeto:</div>
    <select class="form-control" name="status">
      <option value="aberto">Aberto</option>
      <option value="fechado">Fechado</option>
      <option value="aguardando aprovação">Aguardando aprovação</option>
    </select>
    <div class="titulo">Data de entrega prevista:</div>
    <input type="date" class="form-control" name="dataprevista" value="" required>
    <button type="submit" name="button">SALVAR  <i class="fas fa-save"></i></button>
  </form>
@endsection
