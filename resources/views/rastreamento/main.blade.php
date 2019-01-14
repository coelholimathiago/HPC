@extends('layouts.main')

@section('conteudo')
  <form class="" action="{{route('buscaRastreamento')}}" method="post">
    {!! csrf_field() !!}
    <input type="text" name="codigoFuncionario" value="">
    <button type="submit" name="button">Buscar</button>
  </form>
@endsection
