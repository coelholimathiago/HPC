@extends('layouts.forms')

@section('nome')
  NOVO CENTRO DE CUSTO
@endsection

@section('dados')
  @if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
      @endforeach
    </div>
  @endif
  @if (!isset($infoCentro))
    <form class="form-group" action="{{route('cadastro.centrocusto.store')}}" method="post">
  @else
    <form class="form-group" action="{{route('cadastro.centrocusto.update',$infoCentro->id)}}" method="post">
    {!! method_field('PUT') !!}
  @endif
    {!! csrf_field() !!}
    <div class="titulo">Nome do centro:</div>
    <input type="text" class="form-control" name="centroCusto" value="{{$infoCentro->centro or old('centroCusto')}}" required>
    <div class="titulo">Custo / hora:</div>
    <input type="number" class="form-control" name="custoHora" step="0.05" value="{{$infoCentro->custohora or old('custoHora')}}" required>
    <button type="submit" name="salvar">SALVAR <i class="fas fa-save"></i></button>
  </form>
@endsection
