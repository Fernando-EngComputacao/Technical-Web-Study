<!DOCTYPE html>
<?php
  include 'session.php';

  function master($codigo) {
      if($_SESSION['sujif']['master'] == 0){
          echo $codigo;
      }
  }
?>
<html lang="pt" dir="ltr">
  <head>
    <title>SUJIF - Sistema Unificado para os Jogos dos Institutos Federais</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../_css/master.css">
    <script src="../_js/jquery_3-3-1.js"></script>
    <script type="text/javascript" src="../_js/sidenav.js"></script>
  </head>
  <body>
      <?php include "../cabecalho.php"; ?>
    <div class="content col-9">
      <h3>Minha Conta</h3><hr><br>
      <div class="dados">
        <?php
          include '../conexao.php';
          $sql = "select administrador.nome, administrador.cpf, administrador.email, administrador.status, competicao.nome, competicao.campus, competicao.data_abertura, competicao.data_encerramento from administrador, competicao where administrador.competicao_id = competicao.id and administrador.id = ?;";
          $stmt = mysqli_prepare($conexao,$sql);
          mysqli_stmt_bind_param($stmt,'i',$_SESSION['sujif']['id']);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$nome,$cpf,$email,$status,$competicao,$campus,$data_abertura,$data_encerramento);
          mysqli_stmt_fetch($stmt);
          if($status == 0){
            $status = "Master";
          }
          else if($status == 1){
            $status = "Comum";
          }
          else if($status == 2){
            $status = "Desativo";
          }

          echo "
            <div class='acc_lef'>
                <img src='../_imagens/icon_user.png' class='ico_usr'><br>
                <div class='alt_dados'>
                    <a href='cadastrar_administrador.php?i=" . $_SESSION['sujif']['id'] . "'>Alterar dados</a>
                </div>
            </div>

            <div class='inf_conta'>
                <span>Nome: </span><br>
                <div class='inf'>$nome</div><br>

                <span>CPF: </span><br>
                <div class='inf'>$cpf</div><br>

                <span>E-mail: </span><br>
                <div class='inf'>$email</div><br>

                <span>Tipo: </span><br>
                <div class='inf'>$status</div><br>

                <span>Participante da competição: </span><br>
                <div class='inf'>$competicao - $campus ($data_abertura - $data_encerramento)</div><br>
            </div>
          ";
        ?>
      </div>
    </div>
  </body>
</html>
