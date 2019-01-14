@extends('layouts.main')

@section('conteudo')
  <p>Nome do funcionário -->{{$funcionario}}</p>
  <p>Lista de processos pausados</p>
  <form class="" action="{{route('iniciaRastreamento')}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="funcionario" value="{{$funcionario}}">
    <input type="text" name="maquina" value="" placeholder="Máquina">
    <input type="text" name="barcode" value="" placeholder="Código de barras">
    <button type="submit" name="button">Iniciar</button>
  </form>
@endsection
