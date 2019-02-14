<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Código de barras | HPC</title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/barcode.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <script type="text/javascript" src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/js/all.js"></script>
  <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
  <script src="/js/barcode.js" charset="utf-8"></script>
  <script src="/js/JsBarcode.all.min.js" charset="utf-8"></script>
</head>
  <body>
    @foreach ($pecasProjeto->peca->tempos as $operacao)
      <div class="rastreamento">
        <div class="info">
          <h4 value="Peça : ">{{$operacao->codigo}}</h4>
          <h4 value="Máquina : ">{{$operacao->centroCusto->centro}}</h4>
          <h4 value="Descrição : ">{{$operacao->descricao}}</h4>
          <h4 value="Tempo estimado : ">{{$operacao->tempoestimado}}</h4>
        </div>
        <svg class="barcode"
          jsbarcode-value="{{$pecasProjeto->id.".".$pecasProjeto->idprojeto.".".$operacao->idpeca.".".$operacao->id.".".$operacao->idcentrocusto.".".$pecasProjeto->idmateriaprima}}"
          jsbarcode-textmargin="0"
          jsbarcode-fontoptions="bold">
        </svg>
      </div>
    @endforeach
  </body>
</html>
