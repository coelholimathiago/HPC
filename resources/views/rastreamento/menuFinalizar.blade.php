@extends('layouts.forms')

@section('nome')
  Finaliza Rastreamento
@endsection

@section('dados')
  @foreach ($buscaFuncionario->registros->where('status','EM ANDAMENTO') as $registro)
    <form action="{{route('finalizaRastreamento')}}" method="post">
      {!! csrf_field() !!}
      <input class="form-control" type="hidden" name="id" value="{{$registro->id}}">
      <div class="titulo">Nome do funcionário:</div>
      <input type="text" class="form-control" name="funcionario" value="{{$buscaFuncionario->nome}}"/>
      <div class="titulo">Projeto:</div>
      <input type="text" class="form-control" name="projeto" value="{{$registro->pecaProjeto->projeto->nome}}"/>
      <div class="titulo">Código da peça:</div>
      <input type="text" class="form-control" name="codigoPeca" value="{{$registro->pecaProjeto->peca->codigo}}">
      <div class="titulo">Operação:</div>
      <input type="text" class="form-control" name="operacao" value="{{$registro->tempos->descricao}}">
      <div class="titulo">Data/hora de início:</div>
      <input type="text" class="form-control" name="horaInicial" value="{{$registro->updated_at}}"/>
      <div class="titulo">Quantidade produzida:</div>
      <input class="form-control" type="number" name="quantidade" value="" min="0" required>
      <div class="opcoes-finalizar">
        <button type="submit" name="button" value="pausar">Pausar <i class="fas fa-pause"></i></button>
        <button type="submit" name="button" value="finalizar">Finalizar <i class="fas fa-stop"></i></button>
      </div>
    </form>
  @endforeach
@endsection
