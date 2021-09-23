<!DOCTYPE html>
<?php
  include 'session.php';
?>
<html lang="pt" dir="ltr">
  <head>
      <title>SUJIF - Sistema Unificado para os Jogos dos Institutos Federais</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../_css/master.css">
    <script type="text/javascript" src="../_js/sidenav.js"></script>
    <script src="../_js/jquery_3-3-1.js" charset="utf-8"></script>
    <script src="../_js/gerenciar_atletas.js" charset="utf-8"></script>

  </head>
  <body>
      <?php include "../cabecalho_professor.php"; ?>


    <div class="content col-9">

        <!-- <h3>Gerenciar Atletas</h3><hr> -->

      <div class="listagem_alunos">

        <div class="pesq">
            <?php
            if(isset($_GET['er'])){
                echo "<span id='error' onload='error()' style='padding: 20px; background: red; color: white;border-radius: 10px;'>Não foi possivel excuir o atleta pois esta vinculado em modalidades. Exclua esses vinculos e tente novamente.</span><br>";
            }
            ?>

            <h3>Atletas cadastradors por você</h3><hr><br>
            <input type="text" id="mpesq" maxlength="60" placeholder="Nome..." value=""> <button id="mbutton" type="button" onclick="pesquisar_meus_alunos()">Pesquisar</button><br><br>

          <div id="lista_meus_alunos">

          </div>

          <script type="text/javascript">
            pesquisar_meus_alunos();
          </script>

      </div>

        <br><br><br>
        <h3>Atletas cadastrados por outros professores de seu campus</h3><hr><br>
        <div class="pesq">
          <input type="text" id="opesq" maxlength="60" placeholder="Nome..." value="">
          <select id="oprofessor">
            <option value="0">Todos os professores</option>
            <?php
              include '../conexao.php';
              $sql = "select professor.id, professor.nome from professor, campus, competicao where professor.campus_id = campus.id and campus.id = ? and competicao.id = professor.competicao_id and competicao.id = (select max(id) from competicao) and professor.id != ?;";
              $stmt = mysqli_prepare($conexao,$sql);
              mysqli_stmt_bind_param($stmt,'ii',$_SESSION['sujif']['campus'],$_SESSION['sujif']['id']);
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt,$id,$nome);
              while(mysqli_stmt_fetch($stmt)){
                echo "<option value='$id'>$nome</option>";
              }
              mysqli_stmt_close($stmt);
            ?>
        </select>
          <button id="obutton" type="button" onclick="pesquisar_outros_alunos()">Pesquisar</button><br><br>

          <div id="lista_outros_alunos">

          </div>
          <script type="text/javascript">
            pesquisar_outros_alunos();
          </script>
        </div>
      </div>
    </div>
  </body>
</html>
