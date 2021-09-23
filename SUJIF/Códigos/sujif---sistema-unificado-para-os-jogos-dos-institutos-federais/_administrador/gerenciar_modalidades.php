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
    <link rel="stylesheet" type="text/css" href="../_css/master.css">
    <script type="text/javascript" src="../_js/sidenav.js"></script>
    <script type="text/javascript" src="../_js/jquery_3-3-1.js" charset="utf-8"></script>
    <script type="text/javascript" src="../_js/gerenciar_modalidades.js"></script>
    <style media="screen">
      .modalidade{
        /* background-color: rgb(212, 203, 204); */
        padding: 20px;
        font-size: 18px;
        /* margin: 10px; */
      }
      .prova{
        margin-top: 5px;
        margin-bottom: 5px;
        border: solid medium green;
        border-radius: 10px;
        display: none;
        padding: 5px;
      }

      .descricao_prova, .descricao_modalidade, .cadastro_prova{
        color: black;
        display: none;
        /* margin-top: 10px; */

      }
      /* .icon{
        height: 30px;
        width: 30px;
      } */
    </style>
  </head>
  <body>
      <?php include "../cabecalho.php"; ?>

    <div class="content col-9">
        <h3>Gerenciar Modalidades</h3><hr>

        <img src="../_imagens/adicionar.png" alt="ADICIONAR" width="50px"> <a href="cadastrar_modalidade.php" class="cad_adm">Cadastrar nova modalidade</a><br>

      <br>
      <div class="listagem">
        <?php
          include '../conexao.php';
          $sql = "select modalidade.id as modalidade_id, modalidade.nome as modalidade, modalidade.descricao as desc_modalidade, prova.id as prova_id, prova.nome as prova, prova.tipo, prova.descricao as desc_prova from  modalidade, prova, competicao where prova.modalidade_id = modalidade.id and modalidade.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) order by modalidade.id asc;";
          $stmt = mysqli_prepare($conexao,$sql);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$modalidade_id, $modalidade, $desc_modalidade, $prova_id, $prova, $prova_tipo, $desc_prova);
          mysqli_stmt_store_result($stmt);
          $atual = $modalidade_id;
          $inicio = 1;
          $cont = 0;
          if(mysqli_stmt_num_rows($stmt) > 0){
            while(mysqli_stmt_fetch($stmt)){
              if($modalidade_id == $atual){
                echo "<div class='prova'>$prova - ";
                if($prova_tipo == 0){
                  echo "Individual";
                }
                else if($prova_tipo == 1){
                  echo "Coletiva";
                }
                echo " <a href='cadastrar_prova.php?i=$prova_id'>Alterar</a><img src='../_imagens/chevron-down.png' class='icon setinha_baixo_desc'><div class='descricao_prova'>$desc_prova</div></div>";
              }
              else{
                echo "<div class='cadastro_prova'><a href='cadastrar_prova.php?im=$atual'><button>Cadastrar prova nessa modalidade</button></a></div></div></div>";
                $atual = $modalidade_id;
                echo "<div class='modalidade'>$modalidade - <a href='alterar_modalidade.php?i=$modalidade_id'>Alterar</a><img src='../_imagens/chevron-down.png' class='icon setinha_baixo'>";
                echo "<div class='descricao_modalidade'>$desc_modalidade</div>";

                echo "<div class='prova'>$prova - ";
                if($prova_tipo == 0){
                  echo "Individual";
                }
                else if($prova_tipo == 1){
                  echo "Coletiva";
                }
                echo " <a href='cadastrar_prova.php?i=$prova_id'>Alterar</a><img src='../_imagens/chevron-down.png' class='icon setinha_baixo_desc'><div class='descricao_prova'>$desc_prova</div></div>";
              }
            }
            echo "<div class='cadastro_prova'><a href='cadastrar_prova.php?im=$atual'><button>Cadastrar prova nessa modalidade</button></a></div></div>";
          }
          else{
            $cont++;
          }
          mysqli_stmt_close($stmt);

          $sql = "select modalidade.id, modalidade.nome, modalidade.descricao from competicao, modalidade left join prova on modalidade.id = prova.modalidade_id where prova.modalidade_id is null and competicao.id = modalidade.competicao_id and competicao.id = (select max(id) from competicao) order by modalidade.id asc;";
          $stmt = mysqli_prepare($conexao,$sql);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$modalidade_id,$modalidade,$desc_modalidade);
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) > 0){
            while(mysqli_stmt_fetch($stmt)){
              echo "<div class='modalidade'>$modalidade - <a href='alterar_modalidade.php?i=$modalidade_id'>Alterar</a><img src='../_imagens/chevron-down.png' class='icon setinha_baixo_desc'>";
              echo "<div class='descricao_modalidade'>$desc_modalidade</div><div class='cadastro_prova'><a href='cadastrar_prova.php?im=$modalidade_id'><button>Cadastrar prova nessa modalidade</button></a></div></div>";
            }
          }
          else{
            $cont++;
          }

          if($cont == 2){
            echo "<div class='modalidade'>Nenhuma modalidade cadastrada</div>";
          }
          mysqli_stmt_close($stmt);
        ?>
      </div>
    </div>
  </body>
</html>
