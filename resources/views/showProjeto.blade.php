@extends('layouts.main')

@push('css')
  <link rel="stylesheet" href="/css/detalhesprojeto.css">
@endpush

@section('titulo')
  Projetos | HPC
@endsection

@section('conteudo')
  <div class="controle-janelas">
    <a href="{{route('home')}}"><i class="fas fa-home"></i></a>
    <strong>></strong>
    <a href="{{route('projetosAbertos')}}"><strong>PROJETOS ABERTOS</strong></a>
    <strong>> DETALHES PROJETO</strong>
  </div>
  <div class="controle-projeto">
    <div class="col-3 info">
      <h3 class="titulo" value="{{$infoProjeto->id}}">{{$infoProjeto->nome}}</h3>
    </div>
    <div class="col-6 cadastro-existente">
      <datalist id="pecas">
        @foreach ($listaPecas as $peca)
          <option value="{{$peca->codigo}}"></option>
        @endforeach
      </datalist>
      <form class="cadastro-peca" action="{{route('adicionarPeca')}}" method="post">
        {!! csrf_field() !!}
        <input type="hidden" name="projeto" value="{{$infoProjeto->id}}">
        <input type="text" list="pecas" name="peca">
        <button type="submit" name="button">
          <h4>Adicionar</h4>
          <i class="fas fa-box-open"></i>
        </button>
      </form>
    </div>
    <div class="col-3 cadastro-novo">
      <a href="{{route('peca.index')}}"><button type="button" name="button">Cadastrar nova peça <i class="fas fa-plus"></i></button></a>
    </div>
  </div>
  <table id="pecas-projeto">
    <thead>
      <th>PEÇA</th>
      <th>MATÉRIA-PRIMA</th>
      <th>TEMPO ESTIMADO</th>
      <th>TEMPO REAL</th>
      <th>CUSTO ESTIMADO (R$)</th>
      <th>STATUS</th>
      <th>AÇÕES</th>
    </thead>
    <tbody>
      @foreach ($listaPecasProjeto as $pecasProjeto)
        <tr>
          <td>{{$pecasProjeto->codigo}}</td>
          <td>{{$pecasProjeto->material}}</td>
          <td>{{$pecasProjeto->tempoestimado}}</td>
          <td class="tempo-real">00:00:00</td>
          <td>{{$pecasProjeto->custoestimado}}</td>
          <td></td>
          <td>
            <form class="" action="{{route('removerPeca')}}" method="post">
              {!! csrf_field() !!}
              <button type="submit" name="remover" value="{{$pecasProjeto->id}}"><i class="fas fa-trash-alt"></i></button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="orcamento">
    <h1 name="titulo">ORÇAMENTO</h1>
    <table id="orcamento-projeto">
      <thead>
        <th>CUSTO TOTAL ESTIMADO</th>
        <th>MARGEM DE LUCRO</th>
        <th>PREÇO FINAL</th>
        <th>AÇÕES</th>
      </thead>
      <form class="" action="{{route('recalcularOrcamento')}}" method="post">
        {!! csrf_field() !!}
        <tbody>
          <td>{{$listaPecasProjeto->sum('custoestimado')}}</td>
          <td>
            <select class="" name="porcentagemLucro">
              <option value="1.65">65%</option>
              <option value="1.5">50%</option>
              <option value="1.3">30%</option>
            </select>
          </td>
          <td><input type="text" name="orcamento" value="{{$listaPecasProjeto->sum('custoestimado')*1.65}}"></td>
          <td>
              <button type="submit" name="idprojeto" value="{{$infoProjeto->id}}">Recalcular</button>
          </td>
        </tbody>
      </form>
    </table>
  </div>
  <div class="estimativas">
    <h1 name="titulo">PROJEÇÕES</h1>
    <h4 value="TEMPO TOTAL ESTIMADO: ">{{gmdate('H:i:s',$listaPecasProjeto->sum('sectempoestimado'))}}</h4>
    <h4 value="CUSTO TOTAL ESTIMADO: ">{{$listaPecasProjeto->sum('custoestimado')}}</h4>
  </div>
@endsection
