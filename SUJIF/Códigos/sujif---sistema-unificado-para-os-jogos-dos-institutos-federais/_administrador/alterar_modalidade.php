<?php
  include 'session.php';
  if(!isset($_GET['i'])){
    header("Location: menu.php");
  }

    function master($codigo) {
        if($_SESSION['sujif']['master'] == 0){
            echo $codigo;
        }
    }
  $id = $_GET['i'];
?>
<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SUJIF - Sistema Unificado para os Jogos dos Institutos Federais</title>
    <link rel="stylesheet" type="text/css" href="../_css/master.css">
    <script type="text/javascript" src="../_js/sidenav.js"></script>
    <script type="text/javascript" src="../_js/jquery_3-3-1.js" charset="utf-8"></script>
    <script type="text/javascript" src="../_js/gerenciar_modalidades.js"></script>
  </head>
  <body>
      <?php include "../cabecalho.php"; ?>

    <div class="content col-9">
        <?php
        if (isset($_GET['er']) && $_GET['er'] == 1) {
            echo "<span class='warning'>Existem provas cadastradas nessa modalidade, delete-as para excluir-la.</span>";
        } else if (isset($_GET['er']) && $_GET['er'] == 2){
            echo "<span class='warning'>Competidores estão cadastrados a essas provas, termine as pendencias e tente novamente.</span>";
        }
        ?>
        <h2>Alterar Modalidade</h2><hr>

      <div class="dados_modalidade">

          <?php
            include '../conexao.php';
            $sql = "select nome, descricao from modalidade where id = ? and competicao_id = (select max(id) from competicao);";
            $stmt = mysqli_prepare($conexao,$sql);
            mysqli_stmt_bind_param($stmt,'i',$id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt,$nome,$descricao);
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 0){
                header("Location: menu.php");
            }
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
          ?>
          <h3><?php echo $nome; ?></h3>
          <p><?php echo "Descrição: " . $descricao; ?></p>
          <br><br>
          <table>
            <tr class="titulo">
              <td colspan="6">Provas desta modalidade</td>
            </tr>
            <tr class="titulo">
              <td>Nome</td>
              <td>Tipo</td>
              <td>Qtd Máx de Participantes</td>
              <td>Descrição</td>
              <td>Editar</td>
              <td>Excluir</td>
            </tr>
            <?php
              $sql = "select id, nome, tipo, qtd_max_atleta, descricao from prova where prova.modalidade_id = ? order by id asc;";
              $stmt = mysqli_prepare($conexao,$sql);
              mysqli_stmt_bind_param($stmt,"i",$id);
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt,$prova_id,$nome_prova,$tipo,$qtd_max_atletas,$descricao);
              mysqli_stmt_store_result($stmt);
              if (mysqli_stmt_num_rows($stmt) > 0) {
                while(mysqli_stmt_fetch($stmt)){
                  echo "<tr><td>$nome: $nome_prova</td><td>";
                  if($tipo == 0){
                    echo "Individual";
                  }
                  else if($tipo == 1){
                    echo "Coletiva";
                  }

                  echo "</td><td>$qtd_max_atletas</td><td>$descricao</td>";
                  echo "<td><a href='cadastrar_prova.php?i=$prova_id'><img class='icon' src='../_imagens/icon_atualizar.png' alt='EDITAR'></a></td>";
                  echo "<td><a href='excluir_prova.php?i=$prova_id&m=" . $_GET['i'] . "'><img class='icon' src='../_imagens/icon_apagar.png' alt='EXCLUIR'></a></td></tr>";
                }
              }
              else {
                echo "<tr><td colspan='6'>Nenhuma prova cadastrada nessa modalidade</td></tr>";
              }
            ?>
            <tr>
              <td colspan="6"><a href='cadastrar_prova.php?im=<?php echo $id; ?>'><button>Cadastrar prova nesta modalidade</button></a></td>
            </tr>
          </table><br><br>
      </div>

      <div class="opcoes">
          <img src="../_imagens/icon_atualizar.png"><a style="color: #127547;" href='cadastrar_modalidade.php?i=<?php echo $id; ?>'> Editar dados da Modalidade</a><br>
          <img src="../_imagens/adicionar.png" alt=""><a  style="color: grey;" href='cadastrar_prova.php?im=<?php echo $id; ?>'> Cadastrar prova nessa modalidade</a><br>
          <img src="../_imagens/icon_apagar.png" ><a style="color: red;" href='excluir_modalidade.php?i=<?php echo $id; ?>'> Excluir esta modalidade</a><br>
      </div>
      <!-- <div class="opcoes">
        <a href='cadastrar_modalidade.php?i=<?php echo $id; ?>'>Alterar dados da modalidade</a><br><br>
        <a href='cadastrar_prova.php?im=<?php echo $id; ?>'>Cadastrar prova nessa modalidade</a><br><br>
        <a href='excluir_modalidade.php?i=<?php echo $id; ?>'>Excluir está modalidade</a><br><br>
      </div> -->
    </div>
  </body>
</html>
