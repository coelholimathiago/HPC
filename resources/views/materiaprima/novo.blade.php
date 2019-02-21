@extends('layouts.forms')

@section('nome')
  NOVA MATÉRIA-PRIMA
@endsection

@section('dados')
  @if (isset($infoMP))
    <form action="{{route('cadastro.materiaprima.update',$infoMP->id)}}" method="post">
    {!! method_field('PUT') !!}
  @else
    <form action="{{route('cadastro.materiaprima.store')}}" method="post">
  @endif
    {!! csrf_field() !!}
    <div class="titulo">Nome do material:</div>
    <input type="text" class="form-control" name="material" value="{{$infoMP->material or old('material')}}" required>
    <button type="submit" name="button">SALVAR <i class="fas fa-save"></i></button>
  </form>
@endsection
