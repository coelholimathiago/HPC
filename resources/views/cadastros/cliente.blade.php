@extends('layouts.forms')

@section('nome')
  NOVO CLIENTE
@endsection

@section('alertas')
  @if (isset($errors) && count($errors) > 0)
    <div class="exibir">
      <h4>Teste</h4>
      @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
      @endforeach
    </div>
  @endif
@endsection

@section('dados')
  @if (!isset($infoCliente))
    <form class="form-group" action="{{route('cadastro.cliente.store')}}" method="post">
  @else
    <form class="form-group" action="{{route('cadastro.cliente.update',$infoCliente->id)}}" method="post">
    {!! method_field('PUT') !!}
  @endif
    {!! csrf_field() !!}
    <div class="titulo">Nome do cliente:</div>
    <input type="text" class="form-control" name="cliente" value="{{$infoCliente->cliente or old('cliente')}}">
    <div class="titulo">Endereço:</div>
    <input type="text" class="form-control" name="endereco" value="{{$infoCliente->endereco or old('endereco')}}">
    <div class="titulo">Telefone:</div>
    <input type="text" class="form-control" name="telefone" value="{{$infoCliente->telefone or old('telefone')}}">
    <div class="titulo">Email:</div>
    <input type="text" class="form-control" name="email" value="{{$infoCliente->email or old('email')}}">
    <div class="titulo">CNPJ:</div>
    <input type="text" class="form-control" name="cnpj" value="{{$infoCliente->cnpj or old('cnpj')}}">
    <div class="titulo">Inscrição Estadual:</div>
    <input type="text" class="form-control" name="inscricao" value="{{$infoCliente->inscricaoestadual or old('inscricao')}}">
    <button type="submit" name="salvar">SALVAR <i class="fas fa-save"></i></button>
  </form>
@endsection
