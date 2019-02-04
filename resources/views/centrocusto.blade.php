@extends('layouts.tabelas')

@section('titulo-elementos')
  <h4>LISTA DE CENTROS DE CUSTO</h4>
@endsection

@section('pesquisa-elementos')
  <input type="text" name="" value="" placeholder="Pesquisar...">
@endsection

@section('novo-elemento')
  <a href="{{route('cadastro.centrocusto.create')}}"><button type="button" name="button">Novo centro de custo <i class="fas fa-plus"></i></button></a>
@endsection

@section('lista')
  <table>
    <thead>
      <th>CENTRO DE CUSTO</th>
      <th>CUSTO / HORA</th>
      <th>AÇÕES</th>
    </thead>
    <tbody>
      @foreach ($listaCentros as $centro)
        <tr>
          <td align="center">{{$centro->centro}}</td>
          <td align="center">{{$centro->custohora}}</td>
          <td align="center">
            <a href="{{route('cadastro.centrocusto.edit',$centro->id)}}"><button type="button" name="button"><i class="fas fa-edit"></i></button></a>
            <a href="{{route('cadastro.centrocusto.show',$centro->id)}}"><button type="button" name="button"><i class="fas fa-eye"></i></button></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
