function cadastrar_campus(value) {
  if(value != "0"){
    document.getElementById('new_campus').style.display = "none";
  }
  else{
    document.getElementById('new_campus').style.display = "inline";
  }
}
function esconder_msg(){
  document.getElementById("msg").style.display = "none";
}
