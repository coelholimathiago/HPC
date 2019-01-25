@extends('layouts.forms')

@section('nome')
  NOVA MÁQUINA
@endsection

@section('dados')
  @if (isset($infoMaquinas))
    <form action="{{route('cadastro.maquina.update',$infoMaquinas->id)}}" method="post">
    {!! method_field('PUT') !!}
  @else
    <form action="{{route('cadastro.maquina.store')}}" method="post">
  @endif
    {!! csrf_field() !!}
    <div class="titulo">Descrição:</div>
    <input type="text" class="form-control" name="descricao" value="{{$infoMaquinas->descricao or old('descricao')}}" required>
    <div class="titulo">Modelo:</div>
    <input type="text" class="form-control" name="modelo" value="{{$infoMaquinas->modelo or old('modelo')}}" required>
    <div class="titulo">Nomde do fabricante:</div>
    <input type="text" class="form-control" name="fabricante" value="{{$infoMaquinas->fabricante or old('fabricante')}}" required>
    <div class="titulo">Ano de fabricação:</div>
    <input type="text" class="form-control" name="ano" value="{{$infoMaquinas->ano or old('ano')}}" required>
    <div class="titulo">Preço:</div>
    <input type="text" class="form-control" name="preco" value="{{$infoMaquinas->preco or old('preco')}}" required>
    <div class="titulo">Custo / hora:</div>
    <input type="text" class="form-control" name="custohora" value="{{$infoMaquinas->custohora or old('custohora')}}" required>
    <button type="submit" name="button">SALVAR <i class="fas fa-save"></i></button>
  </form>
@endsection
