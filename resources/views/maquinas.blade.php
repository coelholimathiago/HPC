@extends('layouts.main')

@section('conteudo')
  <h1>MÁQUINAS</h1>
  <a href="{{route('cadastro.maquina.create')}}"><button type="button" name="button">Nova máquina</button></a>
  <table class="table table-bordered table-striped">
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
          <td>{{$maquinas->descricao}}</td>
          <td>{{$maquinas->modelo}}</td>
          <td>{{$maquinas->fabricante}}</td>
          <td>{{$maquinas->ano}}</td>
          <td>{{$maquinas->preco}}</td>
          <td>{{$maquinas->custohora}}</td>
          <td>
            <a href="{{route('cadastro.maquina.edit',$maquinas->id)}}"><button type="button" name="button">Editar</button></a>
            <a href="{{route('cadastro.maquina.show',$maquinas->id)}}"><button type="button" name="button">Excluir</button></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
