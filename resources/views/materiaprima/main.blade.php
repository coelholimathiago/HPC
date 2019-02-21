@extends('layouts.tabelas')

@section('titulo')
  Matéria-prima | HPC
@endsection

@section('titulo-elementos')
  <h4>LISTA DE MATÉRIAS-PRIMAS</h4>
@endsection

@section('pesquisa-elementos')
  <input type="text" name="" value="" placeholder="Pesquisar...">
@endsection

@section('novo-elemento')
  <a href="{{route('cadastro.materiaprima.create')}}"><button type="button" name="button">Nova matéria-prima <i class="fas fa-plus"></i></button></a>
@endsection

@section('lista')
  <table>
    <thead>
      <th>ID</th>
      <th>MATERIAL</th>
      <th>AÇÕES</th>
    </thead>
    <tbody>
      @foreach ($listaMP as $materiaPrima)
        <tr>
          <td align="center">{{$materiaPrima->id}}</td>
          <td align="center">{{$materiaPrima->material}}</td>
          <td align="center">
            <a href="{{route('cadastro.materiaprima.edit',$materiaPrima->id)}}"><button type="button" name="button"><i class="fas fa-edit"></i></button></a>
            <a href="{{route('cadastro.materiaprima.show',$materiaPrima->id)}}"><button type="button" name="button"><i class="fas fa-eye"></i></button></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
