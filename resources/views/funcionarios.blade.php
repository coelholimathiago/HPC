@extends('layouts.main')

@section('conteudo')
  <h1>FUNCIONÁRIOS</h1>
  <a href="/cadastro/funcionario/create"><button type="button" name="button">Novo Funcionário</button></a>
  <table class="table table-striped table-bordered">
    <thead>
      <th>NOME</th>
      <th>CARGO</th>
      <th>CUSTO/HORA</th>
      <th>AÇÕES</th>
    </thead>
    <tbody>
      @foreach ($funcionarios as $funcionario)
        @if ($funcionario->ativo == 1)
          <tr>
            <td>{{$funcionario->nome}}</td>
            <td>{{$funcionario->cargo}}</td>
            <td>{{$funcionario->custohora}}</td>
            <td>
              <a href="{{route('cadastro.funcionario.edit',$funcionario->id)}}"><button type="button" name="button">Editar</button></a>
              <a href="{{route('cadastro.funcionario.show',$funcionario->id)}}"><button type="button" name="button">Excluir</button></a>
            </td>
          </tr>
        @endif
      @endforeach
    </tbody>
  </table>
@endsection
