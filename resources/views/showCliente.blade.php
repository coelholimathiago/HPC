@extends('layouts.show')

@section('titulo-detalhes')
  DETALHES DO CLIENTE
@endsection

@section('formulario-detalhes')
  <form class="" action="{{route('cadastro.cliente.destroy',$infoCliente->id)}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="DELETE">
    <label for="cliente">Cliente:</label>
    <input class="form-control" type="text" name="cliente" value="{{$infoCliente->cliente}}">
    <label for="endereco">Endereco:</label>
    <input class="form-control" type="text" name="endereco" value="{{$infoCliente->endereco}}">
    <label for="telefone">Telefone:</label>
    <input class="form-control" type="text" name="telefone" value="{{$infoCliente->telefone}}">
    <button type="submit" name="button">Deletar cliente</button>
  </form>
@endsection
