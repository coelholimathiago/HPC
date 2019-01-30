@extends('layouts.main')

@section('titulo')
  Painel | HPC
@endsection

@push('css')
  <link rel="stylesheet" href="/css/painel.css">
@endpush

@section('conteudo')
  <div class="cabecalho">
    PROJETOS
  </div>
  <div class="projetos">
    <a href="{{url('/projetos/abertos')}}"><button type="button" name="button">Abertos <i class="fas fa-box-open"></i></button></a>
    <a href="{{url('/projetos/fechados')}}"><button type="button" name="button">Finalizados <i class="fas fa-boxes"></i></button></a>
    <a href="{{url('/projetos/aguardando')}}"><button type="button" name="button">Aguardando <i class="fas fa-boxes"></i></button></a>  
    <a href="{{url('/projetos/novo')}}"><button type="button" name="button">Novo <i class="fas fa-file"></i></button></a>
  </div>
  <div class="cabecalho">
    CADASTROS
  </div>
  <div class="cadastros">
    <a href="{{url('/cadastro/maquina')}}"><button type="button" name="button">Máquinas <i class="fas fa-wrench"></i></button></a>
    <a href="{{url('/cadastro/cliente')}}"><button type="button" name="button">Clientes <i class="fas fa-address-book"></i></button></a>
    <a href="{{url('/cadastro/funcionario')}}"><button type="button" name="button">Funcionários <i class="fas fa-handshake"></i></button></a>
    <a href="/peca"><button type="button" name="button">Peças</button></a>
    <a href="{{url('/rastreamento')}}"><button type="button" name="button">Rastreamento <i class="fas fa-barcode"></i></button></a>
  </div>

@endsection
