$(document).ready(function(){

  $('.mostra-itens').click(function(){
    $('.copia[value=' + $(this).val() + ']').toggle();
  });

});
