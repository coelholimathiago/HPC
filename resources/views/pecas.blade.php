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
      <th>DESENHO</th>
      <th>MAQUINA</th>
      <th>TEMPO ESTIMADO</th>
    </thead>
    <tbody>
      @foreach ($listaPecas as $peca)
        <tr>
          <td>{{$peca->codigo}}</td>
          <td>{{$peca->descricao}}</td>
          <td>{{$peca->idmateriaprima}}</td>
          <td>{{$peca->desenho}}</td>
          <td>{{$peca->idmaquina}}</td>
          <td>{{$peca->tempoestimado}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
