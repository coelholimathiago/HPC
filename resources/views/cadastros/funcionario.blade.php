@extends('layouts.forms')

@section('nome')
  NOVO FUNCIONÁRIO
@endsection

@section('dados')
  @if(isset($dadosFuncionario))
    <form class="form-group" action="{{route('cadastro.funcionario.update',$dadosFuncionario->id)}}" method="post">
    {!! method_field('PUT') !!}
  @else
    <form class="form-group" action="{{route('cadastro.funcionario.store')}}" method="post">
  @endif
    {!! csrf_field() !!}
    <div class="titulo">Nome completo:</div>
    <input type="text" class="form-control" name="nome" value="{{$dadosFuncionario->nome or old('nome')}}" required>
    <div class="titulo">Cargo:</div>
    <input type="text" class="form-control" name="cargo" value="{{$dadosFuncionario->cargo or old('cargo')}}" required>
    <div class="titulo">Custo / hora:</div>
    <input type="text" class="form-control" name="custohora" value="{{$dadosFuncionario->custohora or old('custohora')}}" required>
    <label class="container">Produção
      <input type="checkbox" name="ativo" @if(isset($dadosFuncionario) && $dadosFuncionario->ativo == 1) checked @endif>
      <span class="checkmark"></span>
    </label>
    <button type="submit" name="button">SALVAR <i class="fas fa-save"></i></button>
  </form>
@endsection
