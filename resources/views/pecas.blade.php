@extends('layouts.tabelas')

@section('janelas')
  <a href="{{route('home')}}"><i class="fas fa-home"></i></a>
  <strong>> LISTA DE PEÇAS</strong>
@endsection

@section('titulo-elementos')
  <h4>LISTA DE PEÇAS</h4>
@endsection

@section('pesquisa-elementos')
  <input type="text" name="" value="" placeholder="Pesquisar...">
@endsection

@section('novo-elemento')
  <a href="{{route('peca.create')}}"><button type="button" name="button">Nova peça <i class="fas fa-plus"></i></button></a>
@endsection

@section('lista')
  <table>
    <thead>
      <th>CÓDIGO</th>
      <th>DESCRIÇÃO</th>
      <th>MATÉRIA-PRIMA</th>
      <th>AÇÕES</th>
    </thead>
    <tbody>
      @foreach ($listaPecas as $peca)
        <tr>
          <td align="center">{{$peca->codigo}}</td>
          <td>{{$peca->descricao}}</td>
          <td align="center">{{$peca->material}}</td>
          <td align="center">
            <a href="{{route('peca.edit',$peca->id)}}"><button type="button"><i class="fas fa-edit"></i></button></a>
            <a href="{{route('peca.show',$peca->id)}}"><button type="button"><i class="fas fa-eye"></i></button></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
