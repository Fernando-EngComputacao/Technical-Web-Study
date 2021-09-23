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
      <?php include "../cabecalho.php"; ?>

    <div class="content col-9">
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

            mysqli_stmt_close($stmt);

            $tabela_provas = '<table><tr class="titulo"><td colspan="2">Provas do Aluno</td></tr><tr class"titulo"><td><b>Prova</b></td><td><b>Modalidade</b></td></tr>';
            $sql = "select competidor.prova_id, prova.nome, modalidade.nome from competidor, prova, atleta, modalidade where competidor.atleta_id = atleta.id and atleta.id = ? and prova.id = competidor.prova_id and modalidade.id = prova.modalidade_id order by modalidade.nome asc;";
            $stmt = mysqli_prepare($conexao,$sql);
            mysqli_stmt_bind_param($stmt,'i',$id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt,$prova_id,$prova,$modalidade);
            mysqli_stmt_store_result($stmt);

            echo "
            <div class='acc_lef'>
                <img src='../$foto_aluno' class='ico_usr'><br>
            </div>

            <div class='inf_conta'>
                <span>Nome: </span><br>
                <div class='inf'>$nome</div><br>

                <span>Data de Nascimento: </span><br>
                <div class='inf'>$data_nasc</div><br>

                <span>RG: </span><br>
                <div class='inf'>$rg</div><br>

                <span>CPF: </span><br>
                <div class='inf'>$cpf</div><br>

                <span>Sexo: </span><br>
                <div class='inf'>$sexo</div><br>

                <span>Documentos(CPF/RG)(clique nas imagens para baixá-las): </span><br>
                <div class='inf documentos'>
                    <a href='../$foto_cpf' download><img src='../$foto_cpf' alt='FOTO DO CPF'></a>
                    <a href='../$foto_rg' download><img src='../$foto_rg' alt='FOTO DO RG'></a><br>
                </div><br>

                " . $tabela_provas;

                if(mysqli_stmt_num_rows($stmt) > 0){
                  while(mysqli_stmt_fetch($stmt)){
                    echo "<tr><td>$modalidade</td><td>$prova</td> </tr>";
                  }
                }
                else{
                  echo "<tr><td colspan='3'>Nenhuma prova vínculada</td></tr>";
                }
                echo "</table>";

                echo "</div>";
          }
          else{
            header("Location: menu.php");
          }

        ?>
      </div><br>
    </div>
  </body>
</html>
