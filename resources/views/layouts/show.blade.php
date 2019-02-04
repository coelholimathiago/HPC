@extends('layouts.main')

@push('css')
  <link rel="stylesheet" href="/css/show.css">
@endpush

@section('conteudo')
  <div class="detalhes">
    <div class="titulo-detalhes">
      <p>@yield('titulo-detalhes')</p>
    </div>
    <div class="formulario-detalhes">
      @yield('formulario-detalhes')
    </div>
  </div>
@endsection
