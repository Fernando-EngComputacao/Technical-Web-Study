function pesquisar_administrador(){
  var button = document.getElementById("button");
  if(button.innerHTML == "Pesquisar"){
    button.innerHTML = "Pesquisando...";
    var pesq = document.getElementById("pesq").value;
    $.ajax({
      url: "../_administrador/pesquisa_administrador.php",
      type: "post",
      dataType: "html",
      data: {
        'pesq': pesq
      },
      success: function(html) {
        // document.getElementById("resposta").innerHTML = "";
        document.getElementById("resposta").innerHTML = html;
      }
    }).done(function(){
      button.innerHTML = "Pesquisar";
    });
  }
}
