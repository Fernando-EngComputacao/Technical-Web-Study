function pesquisar_meus_alunos(){
  var button = document.getElementById("mbutton");
  if(button.innerHTML == "Pesquisar"){
    button.innerHTML = "Pesquisando...";
    var pesq = document.getElementById("mpesq").value;
    $.ajax({
      url: "../_professor/pesquisar_meus_alunos.php",
      type: "post",
      dataType: "html",
      data: {
        'pesq': pesq
      },
      success: function(html) {
        document.getElementById("lista_meus_alunos").innerHTML = html;
      }
    }).done(function(){
      button.innerHTML = "Pesquisar";
    });
  }
}

function pesquisar_outros_alunos(){
  var button = document.getElementById("obutton");
  if(button.innerHTML == "Pesquisar"){
    button.innerHTML = "Pesquisando...";
    var pesq = document.getElementById("opesq").value;
    var professor = document.getElementById("oprofessor").value;
    $.ajax({
      url: "../_professor/pesquisar_outros_alunos.php",
      type: "post",
      dataType: "html",
      data: {
        'pesq': pesq,
        'professor': professor
      },
      success: function(html) {
        document.getElementById("lista_outros_alunos").innerHTML = html;
      }
    }).done(function(){
      button.innerHTML = "Pesquisar";
    });
  }
}

function pesquisar_atletas(){
  var button = document.getElementById("button");
  if(button.innerHTML == "Pesquisar"){
    button.innerHTML = "Pesquisando...";
    var pesq = document.getElementById("pesq").value;
    var campus = document.getElementById("campus").value;
    $.ajax({
      url: "../_administrador/pesquisar_atletas.php",
      type: "post",
      dataType: "html",
      data: {
        'pesq': pesq,
        'campus': campus
      },
      success: function(html) {
        document.getElementById("lista_atletas").innerHTML = html;
      }
    }).done(function(){
      button.innerHTML = "Pesquisar";
    });
  }
}
