@extends('layouts.main')

@section('conteudo')
  <form class="form-group" action="{{route('projetos.novo.store')}}" method="post">
    {!! csrf_field() !!}
    <input type="text" class="form-control" name="nome" placeholder="Titulo do projeto...">
    <select class="form-control" name="cliente">
      @foreach ($listaClientes as $clientes)
        <option value="{{$clientes->id}}">{{$clientes->cliente}}</option>
      @endforeach
    </select>
    <select class="form-control" name="status">
      <option value="aberto">Aberto</option>
      <option value="fechado">Fechado</option>
      <option value="aguardando aprovação">Aguardando aprovação</option>
    </select>
    <input type="date" class="form-control" name="dataprevista" value="">
    <button type="submit" name="button">Salvar</button>
  </form>
@endsection
