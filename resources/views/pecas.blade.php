@extends('layouts.main')

@section('conteudo')
  <h1>LISTA DE PEÇAS</h1>
  <br>
  <a href="{{route('peca.create')}}"><button type="button" name="button">Nova peça</button></a>
  <table class="table table-bordered table-striped">
    <thead>
      <th>CODIGO</th>
      <th>DESCRIÇÃO</th>
      <th>MATERIA-PRIMA</th>
      <th>AÇÕES</th>
    </thead>
    <tbody>
      @foreach ($listaPecas as $peca)
        <tr>
          <td>{{$peca->codigo}}</td>
          <td>{{$peca->descricao}}</td>
          <td>{{$peca->material}}</td>
          <td>
            <a href="{{route('peca.edit',$peca->id)}}"><button type="button">Editar</button></a>
            <a href="{{route('peca.show',$peca->id)}}"><button type="button">Detalhes</button></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
