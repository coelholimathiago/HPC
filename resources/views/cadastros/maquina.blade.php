@extends('layouts.main')

@section('conteudo')
  @if (isset($infoMaquinas))
    <form class="form-group" action="{{route('cadastro.maquina.update',$infoMaquinas->id)}}" method="post">
    {!! method_field('PUT') !!}
  @else
    <form class="form-group" action="{{route('cadastro.maquina.store')}}" method="post">
  @endif
    {!! csrf_field() !!}
    <input type="text" class="form-control" name="descricao" placeholder="Descrição da máquina" value="{{$infoMaquinas->descricao or old('descricao')}}">
    <input type="text" class="form-control" name="modelo" placeholder="Modelo..." value="{{$infoMaquinas->modelo or old('modelo')}}">
    <input type="text" class="form-control" name="fabricante" placeholder="Fabricante..." value="{{$infoMaquinas->fabricante or old('fabricante')}}">
    <input type="text" class="form-control" name="ano" placeholder="Ano" value="{{$infoMaquinas->ano or old('ano')}}">
    <input type="text" class="form-control" name="preco" placeholder="Preço..." value="{{$infoMaquinas->preco or old('preco')}}">
    <input type="text" class="form-control" name="custohora" placeholder="Custo / hora" value="{{$infoMaquinas->custohora or old('custohora')}}">
    <button type="submit" name="button">Cadastrar</button>
  </form>
@endsection
