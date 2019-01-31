@extends('layouts.main')

@push('css')
  <link rel="stylesheet" href="/css/projetosabertos.css">
  <link href="https://fonts.googleapis.com/css?family=Ranga" rel="stylesheet">
@endpush

@section('titulo')
  Projetos | HPC
@endsection

@section('conteudo')
  @if (count($resumoProjetos) > 0)
    @foreach ($resumoProjetos as $projeto)
      <div class="resumo-projeto">
        <div class="resumo-imagem">
          <img src="/img/sem_foto.png">
        </div>
        <div class="resumo-descricao">
          <h2 name="projeto">{{$projeto->nome}}</h2>
          <h4 name="cliente">{{$projeto->cliente}}</h4>
          <h4 name="dataPrevista"><i class="far fa-calendar-alt"></i> {{date_format(date_create($projeto->dataprevista),'d/m/Y')}}</h4>
        </div>
        <a href="{{route('detalhesProjeto',$projeto->id)}}"><button type="button" name="button">+</button></a>
      </div>
    @endforeach
  @else
    <div class="projetos-vazio">
      <h4><i class="fas fa-exclamation-triangle"></i> Sem projetos finalizados!</h4>
    </div>
  @endif
@endsection
