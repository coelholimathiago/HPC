@extends('layouts.tabelas')

@section('titulo-elementos')
  <h4>LISTA DE FUNCIONÁRIOS</h4>
@endsection

@section('pesquisa-elementos')
  <input type="text" name="" value="" placeholder="Pesquisar...">
@endsection

@section('novo-elemento')
  <a href="/cadastro/funcionario/create"><button type="button" name="button">Novo Funcionário <i class="fas fa-plus"></i></button></a>
@endsection

@section('lista')
  <table>
    <thead>
      <th>NOME</th>
      <th>CARGO</th>
      <th>CUSTO/HORA</th>
      <th>AÇÕES</th>
    </thead>
    <tbody>
      @foreach ($funcionarios->sortBy('nome') as $funcionario)
        @if ($funcionario->ativo == 1)
          <tr>
            <td align="center">{{$funcionario->nome}}</td>
            <td align="center">{{$funcionario->cargo}}</td>
            <td align="center">{{$funcionario->custohora}}</td>
            <td align="center">
              <a href="{{route('cadastro.funcionario.edit',$funcionario->id)}}"><button type="button" name="button"><i class="fas fa-edit"></i></button></a>
              <a href="{{route('cadastro.funcionario.show',$funcionario->id)}}"><button type="button" name="button"><i class="fas fa-eye"></i></button></a>
            </td>
          </tr>
        @endif
      @endforeach
    </tbody>
  </table>
@endsection
