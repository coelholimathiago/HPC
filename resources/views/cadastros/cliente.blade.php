@extends('layouts.main')

@section('conteudo')
  @if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
      @endforeach
    </div>
  @endif
  @if (!isset($infoCliente))
    <form class="form-group" action="{{route('cadastro.cliente.store')}}" method="post">
  @else
    <form class="form-group" action="{{route('cadastro.cliente.update',$infoCliente->id)}}" method="post">
    {!! method_field('PUT') !!}
  @endif
    {!! csrf_field() !!}
    <input type="text" class="form-control" name="cliente" placeholder="Nome" value="{{$infoCliente->cliente or old('cliente')}}">
    <input type="text" class="form-control" name="endereco" placeholder="Endereço" value="{{$infoCliente->endereco or old('endereco')}}">
    <input type="text" class="form-control" name="telefone" placeholder="telefone" value="{{$infoCliente->telefone or old('telefone')}}">
    <input type="text" class="form-control" name="email" placeholder="Email" value="{{$infoCliente->email or old('email')}}">
    <button type="submit" name="salvar">Cadastrar</button>
  </form>
@endsection
