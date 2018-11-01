@extends('layouts.main')

@section('conteudo')
  <p><h1>MOSTRA CLIENTES</h1></p>
  <p><a href="{{route('cadastro.cliente.create')}}"><button type="button" name="button">Novo cliente</button></a></p>
  <table class="table table-striped table-bordered">
    <thead>
      <th>CLIENTE</th>
      <th>ENDEREÇO</th>
      <th>TELEFONE</th>
      <th>EMAIL</th>
      <th>AÇÕES</th>
    </thead>
    <tbody>
      @foreach ($listaClientes as $cliente)
        <tr>
          <td>{{$cliente['cliente']}}</td>
          <td>{{$cliente['endereco']}}</td>
          <td>{{$cliente['telefone']}}</td>
          <td>{{$cliente['email']}}</td>
          <td>
            <a href="{{route('cadastro.cliente.show',$cliente->id)}}"><button type="button" name="button">Excluir</button></a>
            <a href="{{route('cadastro.cliente.edit',$cliente->id)}}"><button type="button" name="button">Editar</button></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
