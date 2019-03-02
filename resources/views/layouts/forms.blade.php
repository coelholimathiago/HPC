@extends('layouts.main')

@push('css')
  <link rel="stylesheet" href="/css/formularios.css">
@endpush

@section('conteudo')
  <div class="formulario">
    <div class="nome-formulario">
      @yield('nome')
    </div>
    <div class="alertas">
      @yield('alertas')
    </div>
    <div class="dados-formulario">
      @yield('dados')
    </div>
  </div>
@endsection
