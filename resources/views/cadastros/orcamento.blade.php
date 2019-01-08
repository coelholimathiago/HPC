@extends('layouts.main')

@push('js')
  <script src="/js/orcamento.js" charset="utf-8"></script>
@endpush

@section('conteudo')
  <div class="controle-janelas">
    <a href="{{route('home')}}"><i class="fas fa-home"></i></a>
    <strong>></strong>
    <a href="{{route('projetosAbertos')}}"><strong>PROJETOS ABERTOS</strong></a>
    <a href="{{route('detalhesProjeto',$id)}}"><strong>> DETALHES PROJETO</strong></a>
    <strong>> ORÇAMENTO</strong>
  </div>
  <form class="" action="" method="post">
    <input type="text" name="custoEstimado" value="{{$custoEstimado}}">
    <input type="text" name="tempoEstimado" value="{{gmdate('H:i:s',$tempoEstimado)}}">
    <input type="text" name="custoFixo" value="59.49">
    <input type="text" name="custoIndireto" value="{{($tempoEstimado/3600)*59.49}}">
    <div class="custos-adicionais">
      <input type="text" name="materiaPrima" placeholder="Custo matéria-prima">
      <input type="text" name="terceiros" placeholder="Custo terceiros">
      <input type="text" name="transporte" placeholder="Transporte">
    </div>
    <button type="submit" name="button">Salvar</button>
  </form>

  <div class="slidecontainer">
    <input type="range" id="margemLucro" class="slider" min="1" max="200" value="100">
    <h2 id="margemSelecionada"></h2>
  </div>
  <button type="button" name="button">Calcular</button>
  <h1 id="orcamento"></h1>
  <h4 id="orcamentos"></h4>
@endsection
