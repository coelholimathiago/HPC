@extends('layouts.main')

@section('conteudo')
  <a href="{{route('truncate',"rastreamento")}}"><button type="button" name="button">Deletar todos os rastreamentos</button></a>
  <a href="{{route('truncate',"pecas")}}"><button type="button" name="button">Deletar todas as peças</button></a>
  <a href="{{route('truncate',"centrocusto")}}"><button type="button" name="button">Deletar todos os centros de custo</button></a>
  <a href="{{route('truncate',"clientes")}}"><button type="button" name="button">Deletar todos os clientes</button></a>
  <a href="{{route('truncate',"funcionarios")}}"><button type="button" name="button">Deletar todos os funcionarios</button></a>
  <a href="{{route('truncate',"maquinas")}}"><button type="button" name="button">Deletar todas as máquinas</button></a>
  <a href="{{route('truncate',"materiaprima")}}"><button type="button" name="button">Deletar todas as matérias-prima</button></a>
  <a href="{{route('truncate',"orcamentos")}}"><button type="button" name="button">Deletar todos os orçamentos</button></a>
  <a href="{{route('truncate',"pecamodelo")}}"><button type="button" name="button">Deletar todas as peças modelo</button></a>
  <a href="{{route('truncate',"pecasprojetos")}}"><button type="button" name="button">Deletar todas as peças projeto</button></a>
  <a href="{{route('truncate',"projetos")}}"><button type="button" name="button">Deletar todos os projetos</button></a>
  <a href="{{route('truncate',"tempospecas")}}"><button type="button" name="button">Deletar todos os tempos de peça</button></a>

@endsection
