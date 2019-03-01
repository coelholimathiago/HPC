@extends('layouts.main')

@push('js')
  <script src="/js/orcamento.js" charset="utf-8"></script>
@endpush

@push('css')
  <link rel="stylesheet" href="/css/orcamento.css">
@endpush

@section('conteudo')
  <form action="{{route('salvarOrcamento')}}" method="post">
    {!! csrf_field() !!}
    <div class="titulo">
      <h4>VALORES ESTIMADOS</h4>
    </div>
    <input type="hidden" name="id" value="{{$id}}">
    <table>
      <thead>
        <th></th>
        <th></th>
      </thead>
      <tbody>
        <tr>
          <td>HORA/MÁQUINA</td>
          <td><input type="text" name="custoEstimado" value="{{$custoBase}}" readonly></td>
        </tr>
        <tr>
          <td>TEMPO ESTIMADO</td>
          <td><input type="text" name="tempoEstimado" value="{{$tempoBase->tempototalprojeto}}" readonly></td>
        </tr>
        <tr>
          <td>HORA/CUSTO INDIRETO</td>
          <td><input type="text" name="custoFixo" value="104.25" readonly></td>
        </tr>
        <tr>
          <td>CUSTO INDIRETO TOTAL</td>
          <td><input type="text" name="custoIndireto" value="{{($tempoBase->sectempoestimado/3600)*104.25}}" readonly></td>
        </tr>
        <tr>
          <td>MATÉRIA-PRIMA</td>
          <td>
            @if (isset($materiaPrima) != null)
              <input class="custos-adicionais" type="text" name="materiaPrima" value="{{$materiaPrima}}" required>
            @else
              <input class="custos-adicionais" type="text" name="materiaPrima" required>
            @endif
          </td>
        </tr>
        <tr>
          <td>CUSTO TERCEIROS</td>
          <td>
            @if (isset($custoTerceiros) != null)
              <input class="custos-adicionais" type="text" name="terceiros" value="{{$custoTerceiros}}" required>
            @else
              <input class="custos-adicionais" type="text" name="terceiros" required>
            @endif
          </td>
        </tr>
        <tr>
          <td>TRANSPORTE</td>
          <td>
            @if (isset($transporte) != null)
              <input class="custos-adicionais" type="text" name="transporte" value="{{$transporte}}" required>
            @else
              <input class="custos-adicionais" type="text" name="transporte" required>
            @endif
          </td>
        </tr>
      </tbody>
    </table>
    <div class="subtotal">
      <p></p>
    </div>
    <div class="slidecontainer">
      <div class="slider">
        <p id="margemSelecionada"></p>
        @if (isset($margemLucro) != null)
          <input type="range" id="margemLucro" name="margemLucro" class="slider" min="0" max="500" value="{{$margemLucro}}">
        @else
          <input type="range" id="margemLucro" name="margemLucro" class="slider" min="0" max="500" value="35">
        @endif
      </div>
    </div>
    <h1 id="orcamento"></h1>
    <div class="salvar">
      <button type="submit" name="button">Salvar <i class="fas fa-save"></i></button>
    </div>
  </form>
@endsection
