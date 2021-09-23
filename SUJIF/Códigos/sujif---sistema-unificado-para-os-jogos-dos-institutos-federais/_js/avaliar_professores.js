function pesquisar_professor(){
  var campus_id, pesq, button = document.getElementById('button');
  if(button.innerHTML == "Pesquisar"){
    button.innerHTML = "Pesquisando...";
    pesq = document.getElementById('pesq').value;
    campus_id = document.getElementById("pesq_campus").value;

    $.ajax({
      url: "../_administrador/pesquisa_professor.php",
      type: "post",
      dataType: "html",
      data: {
        'pesq': pesq,
        'campus_id': campus_id
      },
      success: function(html) {
        document.getElementById("professores").innerHTML = html;
      }
    }).done(function(){
      button.innerHTML = "Pesquisar";
    });
  }
}
