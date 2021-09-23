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
    <meta charset="utf-8">
    <title>SUJIF - Sistema Unificado para os Jogos dos Institutos Federais</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../_css/master.css">
    <script src="../_js/jquery_3-3-1.js"></script>
    <script type="text/javascript" src="../_js/sidenav.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#ico_usr").hover(function(){

            });
        });
    </script>
  </head>
  <body>
      <?php include "../cabecalho_professor.php"; ?>

    <div class="content col-9">
        <br>
      <div class="dados">
        <?php
          include '../conexao.php';
          $sql = "select professor.nome, professor.cpf, professor.rg, professor.telefone, professor.email, professor.num_suap, campus.nome, competicao.nome, competicao.campus, competicao.data_abertura, competicao.data_encerramento from professor, competicao, campus where professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) and professor.campus_id = campus.id and professor.id = ?;";
          $stmt = mysqli_prepare($conexao,$sql);
          mysqli_stmt_bind_param($stmt,'i',$_SESSION['sujif']['id']);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$nome,$cpf,$rg,$telefone,$email,$num_suap,$campus,$competicao,$campus_competicao,$data_abertura,$data_encerramento);
          mysqli_stmt_fetch($stmt);

          echo "

          <div class='acc_lef'>
              <img src='../_imagens/icon_user.png' id='ico_usr' class='ico_usr'><br>

              <div class='opcoes'>
              <img src='../_imagens/icon_atualizar.png'><a style='color: #127547;' href='../cadastro_professor.php?i=alt'>Alterar dados</a>
              </div>
          </div>

          <div class='inf_conta'>
              <h2>Minha Conta</h2>

              <span>Nome: </span><br>
              <div class='inf'>$nome</div><br>

              <span>Campus: </span><br>
              <div class='inf'>$campus</div><br>

              <span>CPF: </span><br>
              <div class='inf'>$cpf</div><br>

              <span>RG: </span><br>
              <div class='inf'>$rg</div><br>

              <span>RG: </span><br>
              <div class='inf'>$num_suap</div><br>

              <span>Telefone: </span><br>
              <div class='inf'>$telefone</div><br>

              <span>E-mail: </span><br>
              <div class='inf'>$email</div><br>

              <span>Participante da competição: </span><br>
              <div class='inf'>$competicao - $campus_competicao ($data_abertura - $data_encerramento)</div><br>
          </div>

          ";
        ?>
    </div><br>
    </div>
  </body>
</html>
