@extends('layouts.forms')

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
          @if ($material == $mp->material)
            <option value="{{$mp->id}}" selected>{{$mp->material}}</option>
          @else
            <option value="{{$mp->id}}">{{$mp->material}}</option>
          @endif
        @else
          <option value="{{$mp->id}}">{{$mp->material}}</option>
        @endif
      @endforeach
    </select>
    <label class="container">Tornar modelo
      <input type="checkbox" name="modelo" @if(isset($infoPeca) && $infoPeca->modelo == "SIM") checked @endif>
      <span class="checkmark"></span>
    </label>
    <button type="submit">Salvar</button>
  </form>
@endsection
