<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SUJIF - Sistema Unificado para os Jogos dos Institutos Federais</title>
    <link rel="stylesheet" type="text/css" href="_css/master.css">
    <script type="text/javascript" src="_js/input_cpf.js"></script>
    <script type="text/javascript" src="_js/jquery_3-3-1.js"></script>
    <script type="text/javascript">

        function trocar_administrador(){
            document.getElementById('login_container').style.marginTop = "-330px";
            document.getElementById('rec_senha').style.display = "none";
            document.getElementById("cpf").style.display = "block";
            $("#cad_pro").hide();
        }

        function trocar_professor(){
            $("#cad_pro").show();
            document.getElementById('login_container').style.marginTop = "-310px";
            document.getElementById("cpf").style.display = "none";
            document.getElementById('rec_senha').style.display = "block";
        }

        function esconder_error(){
            document.getElementById("error").style.opacity = "0";
            setTimeout(function(){
                            document.getElementById("error").style.display = "none";
                            document.getElementById('login_container').style.marginTop = "-300px";
                        }, 500);
        }

        function error() {
            document.getElementById('login_container').style.marginTop = "-330px";
            setTimeout(esconder_error, 3000);
        }

    </script>
    <style media="screen">

    </style>
  </head>
  <body>
      <div id="login_container">
          <img src="_imagens/logo_verde.png" class="logo"><br><br>

          Insira seus dados cadastrais:<br><br>

          <form class="formulario" action="resp_login.php" method="post">
              <?php
              if(isset($_GET['q'])){
                  $q = $_GET['q'];
                  if($q == "error"){
                      echo "<div id='error' onload='error()'><span>Dados Inválidos</span></div>";
                      echo "<script>error();</script>";
                  }
              }
              ?>


              <span>E-Mail:</span><br>
              <input type="text" name="email" placeholder="Insira seu e-mail..." maxlength="80"><br><br>

              <div id="cpf">
                  <span>CPF:</span><br>
                  <input type="text" name="cpf" placeholder="XXX.XXX.XXX-XX" maxlength="14" onkeydown="javascript: fMasc( this, mCPF );"><br><br>
              </div>

              <span>Senha:</span><br>
              <input type="password" name="senha" placeholder="Insira sua senha..." maxlength="60"><br><br>

              <input type="radio" name="tipo" value="1" onclick="trocar_professor()" checked><span>Professor</span>
              <input type="radio" name="tipo" value="0" onclick="trocar_administrador()"><span>Administrador</span><br><br>

              <div id="cad_pro">
                  <a href="cadastro_professor.php" class="esq_senha" id="rec_senha">Não sou cadastrado!</a><br><br>
              </div>

              <!-- <input type="text" name="" placeholder="Login/Email"> <br><br> -->
              <!-- <input type="password" name="" placeholder="Senha"> <br><br> -->
              <!-- <a href="#" class="esq_senha">Esqueci minha senha!</a><br><br> -->
              <!-- <input type="submit" name="" value="Enviar"> <br><br> -->

              <input type="submit" value="Entrar!"><br>
          </form>

      </div>

    <!-- <div class="pagina">
      <form class="formulario" action="resp_login.php" method="post">
        <?php
          if(isset($_GET['q'])){
            $q = $_GET['q'];
            if($q == "error"){
              echo "<div id='error' onclick='esconder_error()'><span>Dados Inválidos</span></div>";
            }
          }
        ?>
        <span>E-mail:</span><input type="text" name="email" placeholder="Insira seu e-mail..." maxlength="80"><br>
        <div id="cpf"><span>CPF:</span><input type="text" name="cpf" placeholder="XXX.XXX.XXX-XX" maxlength="14" onkeydown="javascript: fMasc( this, mCPF );"><br><br></div>
        <span>Senha:</span><input type="password" name="senha" placeholder="Insira sua senha..." maxlength="60"><br>
        <input type="radio" name="tipo" value="1" onclick="trocar_professor()" checked><span>Professor</span>
        <input type="radio" name="tipo" value="0" onclick="trocar_administrador()"><span>Administrador</span><br>
        <a href="#" id="rec_senha">Recuperar sua senha...</a><br><br>
        <input type="submit" value="Entrar!"><br>
      </form>
    </div> -->
  </body>
</html>
