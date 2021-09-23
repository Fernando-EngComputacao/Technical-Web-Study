<!DOCTYPE html>
<?php
  include 'session.php';

  function master($codigo) {
      if($_SESSION['sujif']['master'] == 0){
          echo $codigo;
      }
  }

  if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
  }
  else{
    $msg = 0;
  }
  if(isset($_GET['i'])){
    include '../conexao.php';
    $id = $_GET['i'];
    $sql = "select nome, cpf, email from administrador where id = ?";
    $stmt = mysqli_prepare($conexao,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$nome,$cpf,$email);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
  }
  else{
    include 'session_master.php';
    $id = 0;
    $nome = "";
    $cpf = "";
    $email = "";
  }
?>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SUJIF - Sistema Unificado para os Jogos dos Institutos Federais</title>
    <link rel="stylesheet" type="text/css" href="../_css/master.css">
    <script type="text/javascript" src="../_js/input_cpf.js"></script>
    <script type="text/javascript" src="../_js/sidenav.js"></script>
    <script type="text/javascript" src="../_js/jquery_3-3-1.js"></script>
    <script type="text/javascript" src="../_js/strong_pass.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#senha").keyup(function() {
          passwordStrength(jQuery(this).val());
        });
    });
    </script>

  </head>
  <body>
      <?php include "../cabecalho.php"; ?>

    <div class="content col-9">
        <!-- <a href="menu.php"> <img src="../_imagens/voltar.png" alt="VOLTAR" width="50px"></a> -->

      <!-- <br><br> -->
      <?php
        if($msg != 0){
          echo "<div class='msg'>";
          if($msg == 1){
            echo "Dados Inválidos.";
          }
          else if($msg == 2){
            echo "Senhas desiguais ou menores que 8 caracteres.";
          }
          else if($msg == 3){
            echo "Cadastro realizado com sucesso!";
          }
          else if($msg == 4){
            echo "Erro no Cadastro";
          }
          echo "</div>";
        }

        if (isset($_GET['i'])) {
            echo "<h2>Editar Administrador</h2>";
        } else {
            echo "<h2>Cadastrar Administrador</h2>";
        }
      ?>

      <form class="formulario" action="resp_cadastrar_administrador.php" method="post">
        <input type="hidden" name="i" value="<?php echo $id ?>">
        <span>Nome</span><br><input type="text" name="nome" placeholder="Insira o nome..." maxlength="60" required="Este campo é necessário." value="<?php echo $nome ?>"><br><br>
        <span>CPF</span><br><input type="text" name="cpf" placeholder="XXX.XXX.XXX-XX" maxlength="14" required="Este campo é necessário." onkeydown="javascript: fMasc( this, mCPF );" value="<?php echo $cpf ?>"><br><br>
        <span>E-mail</span><br><input type="text" name="email" placeholder="Insira o e-mail..." maxlength="80" required="Este campo é necessário." value="<?php echo $email ?>"><br><br>
        <span>Senha</span><br><input type="password" id="senha" name="senha1" placeholder="Insira a senha..." maxlength="60" required="Este campo é necessário." value=""><br><br>
          <!-- <h2 class="form-signin-heading">Reset Password</h2> -->
          <!-- <input type="password" id="password" class="form-control first" placeholder="Password" autofocus>
          <input type="password" class="form-control last" placeholder="Confirm Password"> -->
          <span class="forca">Força da Senha:</span> <div class="progress progress-striped active">
            <div id="jak_pstrength" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
        </div> <br><br>
          <!-- <button class="btn btn-lg btn-primary btn-block" type="submit">Save Password</button> -->

        <span>Confirmar Senha</span><br><input type="password" name="senha2" placeholder="Repita a senha..." maxlength="60" required="Este campo é necessário." value=""><br><br>
        <input type="submit" value="Cadastrar">
      </form>
    </div>

  </body>
</html>
