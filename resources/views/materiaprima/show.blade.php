@extends('layouts.show')

@section('titulo-detalhes')
  DETALHES DA MATÉRIA-PRIMA
@endsection

@section('formulario-detalhes')
  <form action="{{route('cadastro.materiaprima.destroy',$infoMP->id)}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="DELETE">
    <label for="descricao">Nome do material:</label>
    <input class="form-control" type="text" name="descricao" value="{{$infoMP->material}}" disabled>
    <button type="submit" name="button">Excluir Máquina</button>
  </form>
@endsection
