@foreach ($busca as $registro)
  @if ($registro->status == "EM ANDAMENTO")
    <form class="" action="{{route('finalizaRastreamento')}}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{$registro->id}}">
      <input name="funcionario" value="{{$registro->func}}"/>
      <input name="projeto" value="{{$registro->projeto}}"/>
      <input name="codigoPeca"/ value="{{$registro->codigo}}">
      <input name="horaInicial" value="{{$registro->horainicial}}"/>
      <button type="submit" name="button" value="finalizar">Finalizar</button>
      <button type="submit" name="button" value="pausar">Pausar</button>
    </form>
  @endif
@endforeach
