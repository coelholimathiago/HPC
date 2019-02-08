@extends('layouts.show')

@section('titulo-detalhes')
  DETALHES FUNCIONÁRIO
@endsection

@section('formulario-detalhes')
  <form class="" action="{{route('cadastro.funcionario.destroy',$dadosFuncionario->id)}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="DELETE">
    <label for="nome">Nome:</label>
    <input class="form-control" type="text" name="nome" value="{{$dadosFuncionario->nome}}">
    <label for="cargo">Cargo:</label>
    <input class="form-control" type="text" name="cargo" value="{{$dadosFuncionario->cargo}}">
    <label for="custohora">Custo/hora:</label>
    <input class="form-control" type="text" name="custohora" value="{{$dadosFuncionario->custohora}}">
    <button type="submit" name="button">Deletar funcionário</button>
  </form>
@endsection
