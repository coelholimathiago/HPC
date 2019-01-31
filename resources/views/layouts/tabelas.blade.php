@extends('layouts.main')

@push('css')
  <link rel="stylesheet" href="/css/tabelas.css">
@endpush

@section('conteudo')
  <div class="cabecalho-elementos">
    @yield('titulo-elementos')
    @yield('pesquisa-elementos')
    @yield('novo-elemento')
  </div>
  <div class="lista-elementos">
    @yield('lista')
  </div>
@endsection
