<!DOCTYPE html>
<?php
  include 'session.php';

  function master($codigo) {
      if($_SESSION['sujif']['master'] == 0){
          echo $codigo;
      }
  }

  if (!isset($_GET['i'])) {
    header("Location: menu.php");
  }
  else{
    $id = $_GET['i'];
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
  </head>
  <body>
      <?php include "../cabecalho_professor.php"; ?>

    <div class="content col-9">
        <h3>Ficha de Atleta</h3>

      <div class="dados">
        <?php
          include '../conexao.php';
          $sql = "select atleta.nome, atleta.cpf, atleta.rg, atleta.data_nascimento, atleta.foto_aluno, atleta.foto_cpf, atleta.foto_rg, atleta.sexo from atleta, competicao, professor where atleta.professor_id = professor.id and professor.competicao_id = competicao.id and atleta.id = ?;";
          $stmt = mysqli_prepare($conexao,$sql);
          mysqli_stmt_bind_param($stmt,'i',$id);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$nome,$cpf,$rg,$data_nasc,$foto_aluno,$foto_cpf,$foto_rg,$sexo);
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_fetch($stmt);
            if($sexo == 1){
              $sexo = "Masculino";
            }
            else if($sexo == 2){
              $sexo = "Feminino";
            }
            echo "<table>
            <tr>
                <td colspan='2'><span><b>Nome:</b> </span><span>$nome</span></td>
                <td><span><b>Data de Nascimento:</b> </span>$data_nasc<span></span></td>
            </tr>

            <tr>
                <td><span><b>RG:</b> </span><span>$rg</span></td>
                <td><span><b>Sexo: </b></span><span>$sexo</span></td>
                <td><span><b>CPF:</b> </span><span>$cpf</span></td>
            </tr>

            <tr>
                <td><span><b>Foto do Aluno:</b></span><br><a href='../$foto_aluno' download><img class='img_cad' src='../$foto_aluno' alt='FOTO DE PERFIL'></a></td>
                <td><span><b>Foto do CPF:</b></span><br><a href='../$foto_cpf' download><img class='img_cad' src='../$foto_cpf' alt='FOTO DO CPF'></a></td>
                <td><span><b>Foto do RG:</b></span><br><a href='../$foto_rg' download><img class='img_cad' src='../$foto_rg' alt='FOTO DO RG'></a><br></td>
            </tr>
            </table><br><br>";
          }
          else{
            header("Location: menu.php");
          }
          mysqli_stmt_close($stmt);

          echo '<table class="modalidades" border="1"><tr class"titulo"><td>Prova</td><td>Modalidade</td><td>Excluir Vínculo</td></tr>';
          $sql = "select competidor.prova_id, prova.nome, modalidade.nome from competidor, prova, atleta, modalidade where competidor.atleta_id = atleta.id and atleta.id = ? and prova.id = competidor.prova_id and modalidade.id = prova.modalidade_id order by modalidade.nome asc;";
          $stmt = mysqli_prepare($conexao,$sql);
          mysqli_stmt_bind_param($stmt,'i',$id);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$prova_id,$prova,$modalidade);
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) > 0){
            while(mysqli_stmt_fetch($stmt)){
              echo "<tr><td>$modalidade</td><td>$prova</td><td><a href='desvincular.php?i=$id&p=$prova_id'><img class='icon' src='../_imagens/icon_apagar.png' alt='EXCLUIR'></a></td></tr>";
            }
          }
          else{
            echo "<tr><td colspan='3'>Nenhuma prova vínculada</td></tr>";
          }
          echo "</table>";
        ?>
    </div><br><br>

      <div class="opcoes">
          <img src="../_imagens/icon_atualizar.png"><a style="color: #127547;" href="cadastrar_atleta.php?i=<?php echo $id; ?>"> Editar dados do atleta</a><br>
          <img src="../_imagens/icon_vinculo.png" alt=""><a  style="color: grey;" href="vincular_provas.php?i=<?php echo $id; ?>"> Vincular o atleta a provas</a><br>
          <img src="../_imagens/icon_apagar.png" ><a style="color: red;" href="excluir_atleta.php?i=<?php echo $id; ?>"> Excluir atleta</a><br>
      </div>
    </div>
  </body>
</html>
