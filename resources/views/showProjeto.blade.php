@extends('layouts.main')

@section('conteudo')
  <h1>DETALHES DO PROJETO</h1>
  <h3>{{$infoProjeto->nome}}</h3>
  <a href="{{route('peca.index')}}"><button type="button" name="button">Adicionar peça inexistente</button></a>
  <datalist id="pecas">
    @foreach ($listaPecas as $peca)
      <option value="{{$peca->codigo}}"></option>
    @endforeach
  </datalist>
  <form class="" action="{{route('adicionarPeca')}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="projeto" value="{{$infoProjeto->id}}">
    <input type="text" list="pecas" name="peca">
    <button type="submit" name="button">Adicionar</button>
  </form>
@endsection
