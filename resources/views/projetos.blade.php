@extends('layouts.main')

@section('conteudo')
  <h1>PROJETOS</h1>
  <br>
  @foreach ($projetosAbertos as $projeto)
    <h3>NOME: {{$projeto->nome}}</h3>
    <h4>Data prevista: {{$projeto->dataprevista}}</h4>
    <h4>Cliente: {{$projeto->cliente}}</h4>
    <a href="{{route('detalhesProjeto',$projeto->id)}}"><button type="button" name="button">Detalhes</button></a>
  @endforeach
@endsection
