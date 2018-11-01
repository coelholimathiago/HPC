@extends('layouts.main')

@section('conteudo')
  <h1>NOVA PEÇA</h1>
  <form class="form-group" action="{{route('peca.store')}}" method="post">
    {!! csrf_field() !!}
    <input class="form-control" type="text" name="codigo" placeholder="Código da peça">
    <input class="form-control" type="text" name="descricao" placeholder="Descrição da peça">
    <select class="form-control" name="materiaprima">
      @foreach ($listaMP as $mp)
        <option value="{{$mp->id}}">{{$mp->material}}</option>
      @endforeach
    </select>
    <input class="form-control" type="file" name="desenho">
    <select class="form-control" name="maquina">
      @foreach ($listaMaquinas as $maquinas)
        <option value="{{$maquinas->id}}">{{$maquinas->descricao}}</option>
      @endforeach
    </select>
    <input type="time" name="tempoestimado" value="">
    <button type="submit" name="button">Salvar</button>
  </form>
@endsection
