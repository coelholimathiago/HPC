@extends('layouts.main')

@push('js')
  <script src="/js/tempos.js" charset="utf-8"></script>
@endpush

@push('css')
  <link rel="stylesheet" href="/css/tempos.css">
@endpush

@section('titulo')
  Tempos | HPC
@endsection

@section('conteudo')

  <li class="item">
    <input type="hidden" name="idpeca" value="{{$id}}">
    <input id="acao" type="hidden" name="acao[]" value="adicionar">
    <select class="" name="centroCusto[]">
      @foreach ($listaCentros as $centro)
        <option value="{{$centro->id}}">{{$centro->centro}}</option>
      @endforeach
    </select>
    <input type="text" name="descricao[]" value="" placeholder="Descrição..." required>
    <input type="time" name="tempoEstimado[]" value="" required>
    <button type="button"><i class="fas fa-minus"></i></button>
  </li>

  <form class="" action="{{route('cadastrarTempos')}}" method="post">
    {{ csrf_field() }}
    <div class="cabecalho-tempos">
      <h4>CADASTRO DE TEMPOS</h4>
      <h4 label="Peça : ">{{$infoPeca->codigo}}</h4>
    </div>
    <ul id="list">
      @foreach ($tempos as $tempo)
        <li>
          <input type="hidden" name="idpeca" value="{{$id}}">
          <input type="hidden" name="idregistro[]" value="{{$tempo->id}}">
          <input id="acao" type="hidden" name="acao[]" value="editar">
          <select class="" name="centroCusto[]">
            @foreach ($listaCentros as $centro)
              <option value="{{$centro->id}}" @if($tempo->idcentrocusto == $centro->id) selected @endif>{{$centro->centro}}</option>
            @endforeach
          </select>
          <input type="text" name="descricao[]" value="{{$tempo->descricao}}" required>
          <input type="time" name="tempoEstimado[]" value="{{$tempo->tempoestimado}}" required>
          <button type="button" class="removerExistente"><i class="fas fa-minus"></i></button>
        </li>
      @endforeach
    </ul>
    <div class="controles-tempos">
      <button type="button" id="add-to-list">Adicionar etapa <i class="fas fa-plus"></i></button>
      <button type="submit" name="button">Salvar <i class="fas fa-save"></i></button>
    </div>
  </form>
@endsection
