@extends('layouts.main')

@section('titulo')
  Finaliza Rastreamento | HPC
@endsection

@section('conteudo')
  @foreach ($buscaFuncionario->registros->where('status','EM ANDAMENTO') as $registro)
    <form action="{{route('finalizaRastreamento')}}" method="post">
      {!! csrf_field() !!}
      <div class="form-group">
        <input class="form-control" type="hidden" name="id" value="{{$registro->id}}">
      </div>
      <div class="form-group">
        <input class="form-control" name="funcionario" value="{{$registro->funcionario}}"/>
      </div>
      <div class="form-group">
        <input class="form-control" name="projeto" value="{{$registro->pecaProjeto->projeto->nome}}"/>
      </div>
      <div class="form-group">
        <input class="form-control" name="codigoPeca" value="{{$registro->pecaProjeto->peca->codigo}}">
      </div>
      <div class="form-group">
        <input class="form-control" name="horaInicial" value="{{$registro->updated_at}}"/>
      </div>
      <div class="form-group">
        <input class="form-control" type="number" name="quantidade" value="" required>
      </div>
      <button type="submit" name="button" class="btn btn-success" value="finalizar">Finalizar</button>
      <button type="submit" name="button" class="btn btn-warning" value="pausar">Pausar</button>
    </form>
  @endforeach
@endsection
