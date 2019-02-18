@extends('layouts.tabelas')

@push('css')
  <link rel="stylesheet" href="/css/listapecas.css">
@endpush

@push('js')
  <script src="/js/listapecas.js" charset="utf-8"></script>
@endpush

@section('titulo-elementos')
  <h4>LISTA DE PEÇAS</h4>
@endsection

@section('pesquisa-elementos')
  <input type="text" name="" value="" placeholder="Pesquisar...">
@endsection

@section('novo-elemento')
  <a href="{{route('peca.create')}}"><button type="button" name="button">Nova peça <i class="fas fa-plus"></i></button></a>
@endsection

@section('lista')
  <table>
    <thead>
      <th></th>
      <th>CÓDIGO</th>
      <th>DESCRIÇÃO</th>
      <th>MATÉRIA-PRIMA</th>
      <th>DESENHO</th>
      <th>AÇÕES</th>
    </thead>
    <tbody>
      @foreach ($listaPecas->where('idmodelo',null)->sortBy('codigo') as $peca)
        @if ($peca->modelo == "SIM")
          <tr>
            <td align="center">
              @if (count($pecasModelo[$peca->id]->copias) > 0)
                <button type="button" name="button" class="mostra-itens" value="{{$peca->id}}"><i class="fas fa-angle-down"></i></button>
              @endif
            </td>
            <td align="center">{{$peca->codigo}}</td>
            <td>{{$peca->descricao}}</td>
            <td align="center">{{$peca->materiaPrima->material}}</td>
            <td align="center"><i class="far fa-file-pdf"></i></td>
            <td align="center">
              <a href="{{route('peca.edit',$peca->id)}}"><button type="button"><i class="fas fa-edit"></i></button></a>
              @if ($peca->modelo == "SIM")
                <a href="{{route('copiaPeca',$peca->id)}}"><button type="button"><i class="far fa-copy"></i></button></a>
              @endif
              <a href="{{route('peca.show',$peca->id)}}"><button type="button"><i class="fas fa-eye"></i></button></a>
            </td>
          </tr>
          @foreach ($pecasModelo[$peca->id]->copias as $copia)
            <tr class="copia" value="{{$peca->id}}">
              <td></td>
              <td align="center">{{$copia->codigo}}</td>
              <td>{{$copia->descricao}}</td>
              <td align="center">{{$copia->materiaPrima->material}}</td>
              <td align="center"><i class="far fa-file-pdf"></i></td>
              <td align="center">
                <a href="{{route('peca.edit',$copia->id)}}"><button type="button"><i class="fas fa-edit"></i></button></a>
                <a href="{{route('peca.show',$copia->id)}}"><button type="button"><i class="fas fa-eye"></i></button></a>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td></td>
            <td align="center">{{$peca->codigo}}</td>
            <td>{{$peca->descricao}}</td>
            <td align="center">{{$peca->materiaPrima->material}}</td>
            <td align="center"><i class="far fa-file-pdf"></i></td>
            <td align="center">
              <a href="{{route('peca.edit',$peca->id)}}"><button type="button"><i class="fas fa-edit"></i></button></a>
              @if ($peca->modelo == "SIM")
                <a href="{{route('copiaPeca',$peca->id)}}"><button type="button"><i class="far fa-copy"></i></button></a>
              @endif
              <a href="{{route('peca.show',$peca->id)}}"><button type="button"><i class="fas fa-eye"></i></button></a>
            </td>
          </tr>
        @endif
      @endforeach
    </tbody>
  </table>
@endsection
