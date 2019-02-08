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
    <div class="titulo">Nome do fabricante:</div>
    <input type="text" class="form-control" name="fabricante" value="{{$infoMaquinas->fabricante or old('fabricante')}}" required>
    <div class="titulo">Ano de fabricação:</div>
    <input type="text" class="form-control" name="ano" value="{{$infoMaquinas->ano or old('ano')}}" required>
    <div class="titulo">Preço:</div>
    <input type="text" class="form-control" name="preco" value="{{$infoMaquinas->preco or old('preco')}}" required>
    <div class="titulo">Centro de custo:</div>
    <select class="form-control" name="centroCusto" required>
      @foreach ($listaCentros as $centro)
        @if (isset($infoMaquinas))
          @if ($centro->id == $infoMaquinas->idcentrocusto)
            <option value="{{$centro->id}}" selected>{{$centro->centro}}</option>
          @else
            <option value="{{$centro->id}}">{{$centro->centro}}</option>
          @endif
        @else
          <option value="{{$centro->id}}">{{$centro->centro}}</option>
        @endif
      @endforeach
    </select>
    <button type="submit" name="button">SALVAR <i class="fas fa-save"></i></button>
  </form>
@endsection
