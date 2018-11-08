@extends('layouts.main')

@push('js')
  <script src="/js/cadastropecas.js" charset="utf-8"></script>
@endpush

@section('conteudo')
  <h1>NOVA PEÇA</h1>
  @if (!isset($infoPeca))
    <form class="form-group" action="{{route('peca.store')}}" method="post">
  @else
    <form class="form-group" action="{{route('peca.update',$infoPeca->codigo)}}" method="post">
    {!! method_field('PUT') !!}
  @endif
    {!! csrf_field() !!}
    <input class="form-control" type="text" name="codigo" placeholder="Código da peça" value="{{$infoPeca->codigo or old('codigo')}}">
    <input class="form-control" type="text" name="descricao" placeholder="Descrição da peça" value="{{$infoPeca->descricao or old('descricao')}}">
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
        @foreach ($tempos as $tempo)
          <h5>{{$tempo->descricao}}</h5>
          <h5>{{$tempo->tempoestimado}}</h5>
        @endforeach
      </div>
    @endif
    <select name="qtdMaquinas">
      <option></option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
    </select>

    <div class="maquina" hidden="true">
      <select>
        @foreach ($listaMaquinas as $maquinas)
          <option value="{{$maquinas->id}}">{{$maquinas->descricao}}</option>
        @endforeach
      </select>
      <input type="time" value="">
    </div>
    <div class="maquinas">

    </div>

    <button type="submit">Salvar</button>
  </form>
@endsection
