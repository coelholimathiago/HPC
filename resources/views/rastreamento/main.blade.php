@extends('layouts.main')

@section('conteudo')
  <div class="controle-janelas">
    <a href="{{route('home')}}"><i class="fas fa-home"></i></a>
    <strong> > RASTREAMENTO</strong>
  </div>
  <form class="" action="{{route('buscaRastreamento')}}" method="post">
    {!! csrf_field() !!}
    <input type="text" name="codigoFuncionario" value="">
    <button type="submit" name="button">Buscar</button>
  </form>
@endsection
