@extends('layouts.forms')

@push('js')
  <script src="/js/cadastropecas.js" charset="utf-8"></script>
@endpush

@push('css')
  <link rel="stylesheet" href="/css/formpeca.css">
@endpush

@section('nome')
  NOVA PEÇA
@endsection

@section('dados')
  @if (!isset($infoPeca))
    <form action="{{route('peca.store')}}" method="post">
  @else
    <form action="{{route('peca.update',$infoPeca->id)}}" method="post">
    {!! method_field('PUT') !!}
  @endif
    {!! csrf_field() !!}
    <div class="titulo">Código: (Ex. SOQ38 P/ Soquetes)</div>
    <input class="form-control" type="text" name="codigo" value="{{$infoPeca->codigo or old('codigo')}}" required>
    <div class="titulo">Descrição:</div>
    <input class="form-control" type="text" name="descricao" value="{{$infoPeca->descricao or old('descricao')}}" required>
    <div class="titulo">Matéria-prima:</div>
    <select class="form-control" name="materiaprima">
      @foreach ($listaMP as $mp)
        @if (isset($material))
          @if ($material->material == $mp->material)
            <option value="{{$mp->id}}" selected>{{$mp->material}}</option>
          @else
            <option value="{{$mp->id}}">{{$mp->material}}</option>
          @endif
        @else
          <option value="{{$mp->id}}">{{$mp->material}}</option>
        @endif
      @endforeach
    </select>
    @if (isset($tempos) && count($tempos) > 0)
      <div class="tempos-anteriores">
        <h4>Tempos antigos</h4>
        <table>
          @foreach ($tempos as $tempo)
            <tr>
              <td>{{$tempo->maquina}}</td>
              <td>{{$tempo->descricao}}</td>
              <td>{{$tempo->tempoestimado}}</td>
            </tr>
          @endforeach
        </table>
      </div>
    @endif
    <div class="titulo">Quantidade de etapas:</div>
    <select class="form-control" name="qtdMaquinas">
      <option></option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
    </select>

    <div class="cadastro-tempo" hidden="true">
      <div class="maquina">
        <h4>Máquina: </h4>
        <select class="form-control">
          @foreach ($listaMaquinas as $maquinas)
            <option value="{{$maquinas->id}}">{{$maquinas->descricao}}</option>
          @endforeach
        </select>
        <h4>Tempo estimado: </h4>
        <input class="form-control" type="time" value="">
        <h4>Descrição: </h4>
        <input class="form-control" type="text" value="">
      </div>
    </div>
    <div class="maquinas"></div>
    <button type="submit">Salvar</button>
  </form>
@endsection
