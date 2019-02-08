@extends('layouts.show')

@section('titulo-detalhes')
  DETALHES DA MÁQUINA
@endsection

@section('formulario-detalhes')
  <form action="{{route('cadastro.maquina.destroy',$infoMaquina->id)}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="DELETE">
    <label for="descricao">Descrição:</label>
    <input class="form-control" type="text" name="descricao" value="{{$infoMaquina->descricao}}">
    <label for="modelo">Modelo:</label>
    <input class="form-control" type="text" name="modelo" value="{{$infoMaquina->modelo}}">
    <label for="fabricante">Fabricante:</label>
    <input class="form-control" type="text" name="fabricante" value="{{$infoMaquina->fabricante}}">
    <label for="ano">Ano:</label>
    <input class="form-control" type="text" name="ano" value="{{$infoMaquina->ano}}">
    <label for="preco">Preço:</label>
    <input class="form-control" type="text" name="preco" value="{{$infoMaquina->preco}}">
    <button type="submit" name="button">Excluir Máquina</button>
  </form>
@endsection
