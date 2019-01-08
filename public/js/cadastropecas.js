$(document).ready(function(){

  $("[name=qtdMaquinas]").change(function()
  {
    $('.maquinas').html('');
    var qtdMaquinas = $(this).val();
    for (var i = 0; i < qtdMaquinas; i++)
    {
      var maquina = $('.maquina:first').clone();
      $(maquina).children("select").attr("name","maquina[]");
      $(maquina).children("input[type='time']").attr("name","tempoestimado[]");
      $(maquina).children("input[type='text']").attr("name","operacao[]");
      $(maquina).attr('hidden',false);
      $('.maquinas').append(maquina);
    }
  });

});
