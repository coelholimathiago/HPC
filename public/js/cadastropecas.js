$(document).ready(function(){

  $("[name=qtdMaquinas]").change(function()
  {
    $('.maquinas').html('');
    var qtdMaquinas = $(this).val();
    for (var i = 0; i < qtdMaquinas; i++)
    {
      var maquina = $('.maquina:first').clone();
      $(maquina).children("select").attr("name","maquina[]");
      $(maquina).children("input").attr("name","tempoestimado[]");
      $(maquina).attr('hidden',false);
      $('.maquinas').append(maquina);
    }
  });

});
