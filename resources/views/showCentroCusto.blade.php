@extends('layouts.show')

@section('titulo-detalhes')
  DETALHES CENTRO CUSTO
@endsection

@section('formulario-detalhes')
  <form action="{{route('cadastro.centrocusto.destroy',$infoCentro->id)}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="DELETE">
    <label for="centroCusto">Centro de custo :</label>
    <input class="form-control" type="text" name="centroCusto" value="{{$infoCentro->centro}}">
    <label for="custoHora">Custo / hora (R$):</label>
    <input class="form-control" type="text" name="custoHora" value="{{$infoCentro->custohora}}">
    <button type="submit" name="button">Deletar</button>
  </form>
@endsection
