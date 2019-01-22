@extends('layouts.main')

@section('conteudo')
  <p>Nome do funcionário -->{{$buscaFuncionario->nome}}</p>
  @foreach ($buscaFuncionario->registros->where('status','PAUSADO') as $registro)
    <form class="" action="{{route('reiniciaRastreamento')}}" method="post">
      {!! csrf_field() !!}
      <input type="text" name="id" value="{{$registro->id}}">
      <input type="text" name="projeto" value="{{$registro->pecaProjeto->projeto->nome}}">
      <input type="text" name="codigo" value="{{$registro->pecaProjeto->peca->codigo}}">
      <input type="text" name="horaInicial" value="{{$registro->updated_at}}">
      <button type="submit" name="button">Reiniciar</button>
    </form>
  @endforeach
  <form class="" action="{{route('iniciaRastreamento')}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="funcionario" value="{{$buscaFuncionario->id}}">
    <input type="text" name="maquina" value="" placeholder="Máquina">
    <input type="text" name="barcode" value="" placeholder="Código de barras">
    <button type="submit" name="button">Iniciar</button>
  </form>
@endsection
