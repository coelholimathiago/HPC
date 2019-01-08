$(document).ready(function(){

  var orcamento = Number($("[name='custoEstimado']").val()) + Number($("[name='custoIndireto']").val());

  $("button").click(function(){
    $(".custos-adicionais > input").each(function(){
      orcamento += Number($(this).val().replace(',','.'));
    });
    document.getElementById('orcamento').innerHTML = orcamento;
  });

  var slider = document.getElementById('margemLucro');
  var margem = document.getElementById('margemSelecionada');
  margem.innerHTML = slider.value;

  slider.oninput = function()
  {
    margem.innerHTML = this.value;
    document.getElementById('orcamentos').innerHTML = orcamento*(this.value/100 + 1);
  }

});
