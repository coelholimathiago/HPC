@extends('layouts.main')

@section('conteudo')
  <h1>DETALHES MÁQUINA</h1>
  <p>
    <label for="descricao">DESCRIÇÃO</label>
    <h4 name="descricao">{{$infoMaquina->descricao}}</h4>
  </p>
  <p>
    <label for="modelo">MODELO</label>
    <h4 name="modelo">{{$infoMaquina->modelo}}</h4>
  </p>
  <p>
    <label for="fabricante">FABRICANTE</label>
    <h4 name="fabricante">{{$infoMaquina->fabricante}}</h4>
  </p>
  <p>
    <label for="ano">ANO</label>
    <h4 name="ano">{{$infoMaquina->ano}}</h4>
  </p>
  <p>
    <label for="preco">PREÇO</label>
    <h4 name="preco">{{$infoMaquina->preco}}</h4>
  </p>
  <p>
    <label for="custohora">CUSTO / HORA</label>
    <h4 name="custohora">{{$infoMaquina->custohora}}</h4>
  </p>
  <form action="{{route('cadastro.maquina.destroy',$infoMaquina->id)}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" name="button">Excluir Máquina</button>
  </form>
@endsection
