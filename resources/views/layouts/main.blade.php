<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('titulo')</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    @stack('css')
    <script type="text/javascript" src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/all.js"></script>
    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
    @stack('js')
  </head>
  <body>
    <div class="painel">
      <ul>
        <li><a href="{{route('home')}}"><img src="/img/Soluções-Industriais-fundo-pnG-sem-risquinho-1024x256.png" alt=""></a></li>
        <div class="dropdown">
          <button class="dropbtn">PROJETOS</button>
          <div class="dropdown-content">
            <a href="{{url('/projetos/abertos')}}">Abertos <i class="fas fa-box-open"></i></a>
            <a href="{{url('/projetos/aguardando')}}">Aguardando</a>
            <a href="{{url('/projetos/fechados')}}">Fechados <i class="fas fa-boxes"></i></a>
            <a href="{{url('/projetos/novo')}}">Novo <i class="fas fa-file"></i></a>
          </div>
        </div>
        <div class="dropdown">
          <button class="dropbtn">CADASTROS</button>
          <div class="dropdown-content">
            <a href="{{url('/cadastro/cliente')}}">Clientes <i class="fas fa-address-book"></i></a>
            <a href="{{url('/cadastro/funcionario')}}">Funcionários <i class="fas fa-handshake"></i></a>
            <a href="{{url('/cadastro/maquina')}}">Máquinas <i class="fas fa-wrench"></i></a>
            <a href="/peca">Peças</a>
          </div>
        </div>
        <div class="dropdown">
          <a href="{{url('/rastreamento')}}"><button class="dropbtn">RASTREAMENTO</button></a>
        </div>
      </ul>
    </div>
    <div class="content">
      @yield('conteudo')
    </div>
    <footer>
      <div class="tecnologia">
        HPC Technologies
        <a href="https://b-m.facebook.com/HPC-Solu%C3%A7%C3%B5es-Industriais-186463188197937/"><i class="fab fa-facebook"></i></a>
      </div>
      <div class="contato-sistema">
        <a href="https://www.linkedin.com/in/thiago-coelho-ba977860/"><i class="fab fa-linkedin"></i></a>
        <a href="https://github.com/coelholimathiago"><i class="fab fa-github"></i></a>
      </div>
      <div class="copyright">
        Desenvolvido por Thiago F.L. Coelho
      </div>
    </footer>
  </body>
</html>
