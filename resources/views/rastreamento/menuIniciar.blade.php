@extends('layouts.main')

@section('conteudo')
  <p>Nome do funcionário -->{{$buscaFuncionario->nome}}</p>
  @if (count($busca) != 0)
    @foreach ($busca as $registro)
      <form class="" action="{{route('reiniciaRastreamento')}}" method="post">
        {!! csrf_field() !!}
        <input type="text" name="id" value="{{$registro->id}}">
        <input type="text" name="projeto" value="{{$registro->projeto}}">
        <input type="text" name="codigo" value="{{$registro->codigo}}">
        <input type="text" name="horaInicial" value="{{$registro->horainicial}}">
        <button type="submit" name="button">Reiniciar</button>
      </form>
    @endforeach
  @endif
  <form class="" action="{{route('iniciaRastreamento')}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="funcionario" value="{{$buscaFuncionario->id}}">
    <input type="text" name="maquina" value="" placeholder="Máquina">
    <input type="text" name="barcode" value="" placeholder="Código de barras">
    <button type="submit" name="button">Iniciar</button>
  </form>
@endsection
