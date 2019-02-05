@extends('layouts.tabelas')

@section('titulo-elementos')
    <h4>LISTA DE MÁQUINAS</h4>
@endsection

@section('pesquisa-elementos')
  <input type="text" name="" value="" placeholder="Pesquisar...">
@endsection

@section('novo-elemento')
  <a href="{{route('cadastro.maquina.create')}}"><button type="button" name="button">Nova máquina <i class="fas fa-plus"></i></button></a>
@endsection

@section('lista')
  <table>
    <thead>
      <th>DESCRIÇÃO</th>
      <th>MODELO</th>
      <th>FABRICANTE</th>
      <th>ANO</th>
      <th>PREÇO</th>
      <th>CUSTO HORA</th>
      <th>AÇÕES</th>
    </thead>
    <tbody>
      @foreach ($listaMaquinas as $maquinas)
        <tr>
          <td align="center">{{$maquinas->descricao}}</td>
          <td align="center">{{$maquinas->modelo}}</td>
          <td align="center">{{$maquinas->fabricante}}</td>
          <td align="center">{{$maquinas->ano}}</td>
          <td align="center">{{$maquinas->preco}}</td>
          <td align="center">{{$maquinas->centroCusto->custohora}}</td>
          <td align="center">
            <a href="{{route('cadastro.maquina.edit',$maquinas->id)}}"><button type="button" name="button"><i class="fas fa-edit"></i></button></a>
            <a href="{{route('cadastro.maquina.show',$maquinas->id)}}"><button type="button" name="button"><i class="fas fa-eye"></i></button></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
