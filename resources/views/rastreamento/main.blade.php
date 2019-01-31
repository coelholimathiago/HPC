@extends('layouts.main')

@push('css')
  <link rel="stylesheet" href="/css/rastreamento.css">
@endpush

@section('conteudo')
  <form class="busca-rastreamento" action="{{route('buscaRastreamento')}}" method="post">
    {!! csrf_field() !!}
    <select class="" name="codigoFuncionario">
      @foreach ($funcionarios as $funcionario)
        <option value="{{$funcionario->id}}">{{$funcionario->nome}}</option>
      @endforeach
    </select>
    <button type="submit" name="button">Buscar</button>
  </form>
@endsection
