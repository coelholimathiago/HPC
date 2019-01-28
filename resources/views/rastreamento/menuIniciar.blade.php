@extends('layouts.main')

@push('css')
  <link rel="stylesheet" href="/css/rastreamento.css">
@endpush

@section('conteudo')
  <div class="menu-iniciar">
    <div class="cabecalho">
      {{$buscaFuncionario->nome}}
    </div>
    <div titulo="PROCESSO NOVO" class="menu-item novo">
      <form class="" action="{{route('iniciaRastreamento')}}" method="post">
        {!! csrf_field() !!}
        <input type="hidden" name="funcionario" value="{{$buscaFuncionario->id}}">
        <input type="text" name="maquina" value="" placeholder="Máquina" required>
        <input type="text" name="barcode" value="" placeholder="Código de barras" required>
        <button type="submit" name="button">Iniciar <i class="fas fa-play"></i></button>
      </form>
    </div>
    <div titulo="PROCESSOS PAUSADOS" class="menu-item pause">
      @foreach ($buscaFuncionario->registros->where('status','PAUSADO') as $registro)
        <form class="" action="{{route('reiniciaRastreamento')}}" method="post">
          {!! csrf_field() !!}
          <input type="hidden" name="id" value="{{$registro->id}}">
          <input type="text" name="projeto" value="{{$registro->pecaProjeto->projeto->nome}}">
          <input type="text" name="codigo" value="{{$registro->pecaProjeto->peca->codigo}}">
          <input type="text" name="horaInicial" value="{{$registro->updated_at}}">
          <button type="submit" name="button">Reiniciar <i class="fas fa-sync-alt"></i></button>
        </form>
      @endforeach
    </div>
  </div>
@endsection
