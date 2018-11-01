@extends('layouts.main')

@section('conteudo')
  <h1>DETALHES CLIENTE</h1>
  <p>
    <label for="cliente">Cliente:</label>
    <h4 name="cliente">{{$infoCliente->cliente}}</h4>
  </p>
  <p>
    <label for="endereco">Endereco:</label>
    <h4 name="endereco">{{$infoCliente->endenreco}}</h4>
  </p>
  <p>
    <label for="telefone">Telefone:</label>
    <h4 name="telefone">{{$infoCliente->telefone}}</h4>
  </p>
  <form class="" action="{{route('cadastro.cliente.destroy',$infoCliente->id)}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" name="button">Deletar cliente</button>
  </form>
@endsection
