@extends('layouts.show')

@section('titulo-detalhes')
  DETALHES DA PEÇA
@endsection

@section('formulario-detalhes')
  <form action="{{route('peca.destroy',$infoPeca->id)}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="DELETE">
    <label for="centroCusto">Código da peça :</label>
    <input class="form-control" type="text" value="{{$infoPeca->codigo}}" disabled>
    <label for="centroCusto">Descrição :</label>
    <input class="form-control" type="text" value="{{$infoPeca->descricao}}" disabled>
    <label for="centroCusto">Matéria-prima :</label>
    <input class="form-control" type="text" value="{{$infoPeca->materiaPrima->material}}" disabled>
    <button type="submit" name="button">Deletar esta peça</button>
  </form>
@endsection
