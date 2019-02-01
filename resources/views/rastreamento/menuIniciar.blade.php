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
        <select class="" name="maquina">
          @foreach ($maquinas as $maquina)
            <option value="{{$maquina->id}}">{{$maquina->descricao}}</option>
          @endforeach
        </select>
        <input type="text" name="barcode" value="" placeholder="Código de barras" required>
        <button type="submit" name="button">Iniciar <i class="fas fa-play"></i></button>
      </form>
    </div>
    <div titulo="PROCESSOS PAUSADOS" class="menu-item pause">
      @foreach ($buscaFuncionario->registros->where('status','PAUSADO') as $registro)
        <form class="processos-pausados" action="{{route('reiniciaRastreamento')}}" method="post">
          {!! csrf_field() !!}
          <div class="resumo">
            <input type="hidden" name="id" value="{{$registro->id}}">
            <h5 titulo="Projeto: ">{{$registro->pecaProjeto->projeto->nome}}</h5>
            <h5 titulo="Peça: ">{{$registro->pecaProjeto->peca->codigo}}</h5>
            <h5 titulo="Operação: ">{{$registro->tempos->descricao}}</h5>
            <h5 titulo="Hora inicial: ">{{$registro->updated_at}}</h5>
          </div>
          <div class="controle-pausados">
            <button type="submit" name="button">Reiniciar <i class="fas fa-sync-alt"></i></button>
          </div>
        </form>
      @endforeach
    </div>
  </div>
@endsection
