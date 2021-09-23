function trocar_administrador(){
    document.getElementById('rec_senha').style.display = "none";
    document.getElementById("cpf").style.display = "inline";
}
function trocar_professor(){
    document.getElementById("cpf").style.display = "none";
    document.getElementById('rec_senha').style.display = "inline";
}
function esconder_error(){
  document.getElementById("error").style.display = "none";
}
