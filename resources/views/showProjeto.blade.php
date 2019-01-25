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
    <div class="info">
      <h3 class="titulo" value="{{$projeto->id}}">{{$projeto->nome}}</h3>
    </div>
    <div class="cadastro-existente">
      <datalist id="pecas">
        @foreach ($listaPecas as $peca)
          <option value="{{$peca->codigo}}"></option>
        @endforeach
      </datalist>
      <form class="cadastro-peca" action="{{route('adicionarPeca')}}" method="post">
        {!! csrf_field() !!}
        <input type="hidden" name="projeto" value="{{$projeto->id}}">
        <input type="text" list="pecas" name="peca" placeholder="Código peça..." required>
        <input type="number" name="quantidade" min="1" max="1000" placeholder="Qtd..." required>
        <button type="submit" name="button">
          <h4>Adicionar <i class="fas fa-box-open"></i></h4>
        </button>
      </form>
    </div>
    <div class="cadastro-novo">
      <a href="{{route('peca.index')}}"><button type="button" name="button">Lista de peças <i class="fas fa-plus"></i></button></a>
    </div>
  </div>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  @if (count($projeto->pecas) > 0)
    <div class="grupo">
      <table class="tabelas-projeto" id="pecas-projeto">
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
          @foreach ($projeto->pecas as $peca)
            <tr>
              <td>{{$peca->peca->codigo}}</td>
              <td>{{$peca->quantidade}}</td>
              <td>{{$peca->materiaPrima->material}}</td>
              <td>{{$peca->tempoestimado}}</td>
              <td class="tempo-real">
                @if (count($peca->rastreamento) > 0)
                  {{$peca->rastreamento()->select(DB::raw('sec_to_time(sum(time_to_sec(tempogasto))) as tempogasto'))->first()->tempogasto}}
                @else
                  00:00:00
                @endif
              </td>
              <td>{{$peca->custoestimado}}</td>
              <td>
                @if (count($peca->rastreamento()->where('status','FINALIZADO')->get()) > 0)
                  <i class="fas fa-check"></i>
                @else
                  <i class="fas fa-spinner"></i>
                @endif
              </td>
              <td>
                <div class="acoes">
                  <div>
                    <a href="barcode/{{$peca->id}}"><button type="button" name="button"><i class="fas fa-barcode"></i></button></a>
                  </div>
                  <div>
                    <form class="" action="{{route('removerPeca')}}" method="post">
                      {!! csrf_field() !!}
                      <button type="submit" name="remover" value="{{$peca->id}}"><i class="fas fa-trash-alt"></i></button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @else
    <div class="grupo">
      <h1 name="titulo">PEÇAS</h1>
      <p msg="Peças não cadastradas!"><i class="fas fa-tasks"></i></p>
    </div>
  @endif

  <div class="grupo orcamento">
    @if ($custos == null)
      <h1 name="titulo">ORÇAMENTO</h1>
      <p msg="Orçamento não cadastrado!"><i class="fas fa-dollar-sign"></i></p>
      <a href="{{route('orcamento',$projeto->id)}}"><button type="button" name="editar-orcamento"><i class="fas fa-edit"></i></button></a>
    @else
      <table class="tabelas-projeto">
        <thead>
          <th><i class="fas fa-wrench"></i> CUSTO BASE</th>
          <th><i class="fas fa-chart-pie"></i> CUSTO INDIRETO</th>
          <th>MATÉRIA-PRIMA</th>
          <th>CUSTOS TERCEIROS</th>
          <th>CUSTO TRANSPORTE</th>
          <th>MARGEM</th>
          <th>CUSTO FINAL</th>
          <th>AÇÕES</th>
        </thead>
        <tbody>
          <td>{{$projeto->orcamento->custobase}}</td>
          <td>{{$projeto->orcamento->custoindireto}}</td>
          <td>{{$projeto->orcamento->materiaprima}}</td>
          <td>{{$projeto->orcamento->custoterceiros}}</td>
          <td>{{$projeto->orcamento->custotransporte}}</td>
          <td>{{$projeto->orcamento->margem}}</td>
          <td>{{$projeto->orcamento->custofinal}}</td>
          <td><a href="{{route('orcamento',$projeto->id)}}"><button type="button"><i class="fas fa-edit"></i></button></a></td>
        </tbody>
      </table>
    @endif
  </div>

{{--
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
    <a href="{{route('orcamento',$projeto->id)}}"><button type="button" name="button"><i class="fas fa-edit"></i></button></a>
  </div>
  <div class="estimativas">
    <h1 name="titulo">PROJEÇÕES</h1>
    <h4 value="TEMPO TOTAL ESTIMADO: ">{{gmdate('H:i:s',$listaPecasProjeto->sum('sectempoestimado'))}}</h4>
    <h4 value="CUSTO TOTAL ESTIMADO: ">{{$listaPecasProjeto->sum('custoestimado')}}</h4>
  </div> --}}
@endsection
