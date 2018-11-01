<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('titulo')</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    @stack('css')
    <script type="text/javascript" src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/all.js"></script>
    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
    @stack('js')
  </head>
  <body>
    @yield('conteudo')
  </body>
</html>
