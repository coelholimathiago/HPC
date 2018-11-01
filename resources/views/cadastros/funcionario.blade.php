@extends('layouts.main')

@section('conteudo')
  @if(isset($dadosFuncionario))
    <form class="form-group" action="{{route('cadastro.funcionario.update',$dadosFuncionario->id)}}" method="post">
    {!! method_field('PUT') !!}
  @else
    <form class="form-group" action="{{route('cadastro.funcionario.store')}}" method="post">
  @endif
    {!! csrf_field() !!}
    <input type="text" class="form-control" name="nome" placeholder="Insira o nome..." value="{{$dadosFuncionario->nome or old('nome')}}">
    <input type="text" class="form-control" name="cargo" placeholder="Cargo..." value="{{$dadosFuncionario->cargo or old('cargo')}}">
    <label><input type="checkbox" name="ativo" @if(isset($dadosFuncionario) && $dadosFuncionario->ativo == 1) checked @endif> Ativo</label>
    <input type="text" class="form-control" name="custohora" placeholder="Insira o custo hora..." value="{{$dadosFuncionario->custohora or old('custohora')}}">
    <button type="submit" name="button">Cadastrar</button>
  </form>
@endsection
