@extends('layouts.main')

@section('conteudo')
  <h1>DETALHES FUNCIONÁRIO</h1>
  <p>
    <label for="nome">Nome:</label>
    <h4 name="nome">{{$dadosFuncionario->nome}}</h4>
  </p>
  <p>
    <label for="cargo">Cargo:</label>
    <h4 name="cargo">{{$dadosFuncionario->cargo}}</h4>
  </p>
  <p>
    <label for="custohora">Custo/hora:</label>
    <h4 name="custohora">{{$dadosFuncionario->custohora}}</h4>
  </p>
  <form class="" action="{{route('cadastro.funcionario.destroy',$dadosFuncionario->id)}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" name="button">Deletar funcionário</button>
  </form>
@endsection
