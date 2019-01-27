@extends('layouts.tabelas')

@section('janelas')
  <a href="{{route('home')}}"><i class="fas fa-home"></i></a>
  <strong>> LISTA DE CLIENTES</strong>
@endsection

@section('titulo-elementos')
  <h4>LISTA DE CLIENTES</h4>
@endsection

@section('pesquisa-elementos')
  <input type="text" name="" value="" placeholder="Pesquisar...">
@endsection

@section('novo-elemento')
  <a href="{{route('cadastro.cliente.create')}}"><button type="button" name="button">Novo cliente <i class="fas fa-plus"></i></button></a>
@endsection

@section('lista')
  <table>
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
          <td align="center">{{$cliente['cliente']}}</td>
          <td align="center">{{$cliente['endereco']}}</td>
          <td align="center">{{$cliente['telefone']}}</td>
          <td align="center">{{$cliente['email']}}</td>
          <td align="center">
            <a href="{{route('cadastro.cliente.edit',$cliente->id)}}"><button type="button" name="button"><i class="fas fa-edit"></i></button></a>
            <a href="{{route('cadastro.cliente.show',$cliente->id)}}"><button type="button" name="button"><i class="fas fa-eye"></i></button></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
