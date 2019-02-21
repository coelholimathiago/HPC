$(document).ready(function(){

  $("#add-to-list").click(function(){
    var teste = $('.item').clone();
    $(teste).attr('class','item-copia');
    $(teste).children("button").attr("class",'remover');
    $('#list').append(teste);
  });

  $("#list").on("click",".removerExistente",function(){
    var itemLista = $(this).parent();
    $(itemLista).find("#acao").attr("value","excluir");
    $(itemLista).toggle();
  });

  $("#list").on("click",".remover",function(){
    var itemLista = $(this).parent();
    $(itemLista).remove();
  });

});
