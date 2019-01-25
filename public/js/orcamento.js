$(document).ready(function(){

  var orcamento = Number($("[name='custoEstimado']").val()) + Number($("[name='custoIndireto']").val());
  var custosAdicionais = Number($("[name='materiaPrima']").val()) + Number($("[name='terceiros']").val()) + Number($("[name='transporte']").val());
  var slider = document.getElementById('margemLucro');
  var margem = document.getElementById('margemSelecionada');
  var orcamentoTotal = (orcamento + custosAdicionais) * (slider.value/100 + 1);
  document.getElementById('orcamento').innerHTML = orcamentoTotal.toFixed(2);
  $('.subtotal > p').html((orcamento + custosAdicionais).toFixed(2));

  $('.custos-adicionais').change(function(){
    custosAdicionais = Number($("[name='materiaPrima']").val().replace(',','.')) + Number($("[name='terceiros']").val().replace(',','.')) + Number($("[name='transporte']").val().replace(',','.'));
    orcamentoTotal = (orcamento + custosAdicionais) * (slider.value/100 + 1);
    $('.subtotal > p').html((orcamento + custosAdicionais).toFixed(2));
    document.getElementById('orcamento').innerHTML = orcamentoTotal.toFixed(2);
  });


  margem.innerHTML = slider.value;

  slider.oninput = function()
  {
    margem.innerHTML = this.value;
    document.getElementById('orcamento').innerHTML = ((orcamento + custosAdicionais)*(this.value/100 + 1)).toFixed(2);
  }

});
