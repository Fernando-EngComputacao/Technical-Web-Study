$(document).ready(function() {
 $(".setinha_baixo").click(function(){
   $(this).parent().find(".descricao_modalidade, .prova, .cadastro_prova").each(function(){
     // $(this).css("display","block");
     if($(this).css("display") == "none"){
       $(this).show("medium");
     }
     else{
       $(this).hide("medium");
     }
   });
 });

 $(".setinha_baixo_desc").click(function(){
   $(this).parent().find(".descricao_prova").each(function(){
     if($(this).css("display") == "none"){
       $(this).show("medium");
     }
     else{
       $(this).hide("medium");
     }
   });
 });
});
