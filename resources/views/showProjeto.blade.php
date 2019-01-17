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
      <a href="{{route('peca.index')}}"><button type="button" name="button">Lista de peças <i class="fas fa-plus"></i></button></a>
    </div>
  </div>
  <table id="pecas-projeto">
    <thead>
      <th>PEÇA</th>
      <th>QUANTIDADE</th>
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
          <td></td>
          <td>{{$pecasProjeto->material}}</td>
          <td>{{$pecasProjeto->tempoestimado}}</td>
          <td class="tempo-real">
            @if (count($tempoGasto->where('idpeca',$pecasProjeto->idpeca)) > 0)
              {{$tempoGasto->where('idpeca',$pecasProjeto->idpeca)->first()->tempogasto}}
            @else
              00:00:00
            @endif
          </td>
          <td>{{$pecasProjeto->custoestimado}}</td>
          <td>
            @if (count($tempoGasto->where('idpeca',$pecasProjeto->idpeca)) > 0)
              {{number_format(($tempoGasto->where('idpeca',$pecasProjeto->idpeca)->first()->sectempogasto/$pecasProjeto->sectempoestimado)*100,2)}} %
            @else
              0 %
            @endif
          </td>
          <td>
            <div class="acoes">
              <div>
                <a href="barcode/{{$pecasProjeto->id}}"><button type="button" name="button"><i class="fas fa-barcode"></i></button></a>
              </div>
              <div>
                <form class="" action="{{route('removerPeca')}}" method="post">
                  {!! csrf_field() !!}
                  <button type="submit" name="remover" value="{{$pecasProjeto->id}}"><i class="fas fa-trash-alt"></i></button>
                </form>
              </div>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="orcamento">
    <h1 name="titulo">ORÇAMENTO</h1>
    @if ($custos == null)
      <p><i class="fas fa-dollar-sign"></i></p>
    @else
      <h1>Orçamento ok!</h1>
    @endif
    <a href="{{route('orcamento',$infoProjeto->id)}}"><button type="button" name="button"><i class="fas fa-edit"></i></button></a>
  </div>
  <div class="estimativas">
    <h1 name="titulo">PROJEÇÕES</h1>
    <h4 value="TEMPO TOTAL ESTIMADO: ">{{gmdate('H:i:s',$listaPecasProjeto->sum('sectempoestimado'))}}</h4>
    <h4 value="CUSTO TOTAL ESTIMADO: ">{{$listaPecasProjeto->sum('custoestimado')}}</h4>
  </div>
@endsection
