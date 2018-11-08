@extends('layouts.main')

@section('conteudo')
  <h1>DETALHES DA PEÇA</h1>
  <h4>{{$infoPeca->codigo}}</h4>
  <h4>{{$infoPeca->descricao}}</h4>
  <h4>{{$infoPeca->material}}</h4>
  @foreach ($tempos as $tempo)
    <h4>{{$tempo->descricao}}</h4>
    <h4>{{$tempo->tempoestimado}}</h4>
    <h4>{{$tempo->custo}}</h4>
  @endforeach
  <form action="{{route('peca.destroy',$infoPeca->id)}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" name="button">Deletar esta peça</button>
  </form>
@endsection
