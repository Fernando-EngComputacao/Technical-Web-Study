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
    <link rel="stylesheet" href="../_css/master.css">
    <script src="../_js/jquery_3-3-1.js" charset="utf-8"></script>
    <script src="../_js/gerenciar_atletas.js" charset="utf-8"></script>
    <script type="text/javascript" src="../_js/sidenav.js"></script>

  </head>
  <body>
      <?php include "../cabecalho.php"; ?>

    <div class="content col-9">
      <div class="listagem_alunos">
        <h2>Atletas cadastrados</h2><hr><br>
        <div class="pesq">
          <input type="text" id="pesq" maxlength="60" placeholder="Nome..." value="">
          <select id="campus">
            <option value="0">Todos os campus</option>
            <?php
              include '../conexao.php';
              $sql = "select campus.id, campus.nome, campus.sigla, campus.uf from campus, professor, competicao where campus.id = professor.campus_id and professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) group by campus.nome order by campus.nome asc;";
              $stmt = mysqli_prepare($conexao,$sql);
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt,$id_campus,$nome_campus,$sigla,$uf);
              mysqli_stmt_store_result($stmt);
              if (mysqli_stmt_num_rows($stmt) > 0) {
                while(mysqli_stmt_fetch($stmt)){
                  echo "<option value='$id_campus'>$nome_campus - $sigla ($uf)</option>";
                }
              }
              mysqli_stmt_close($stmt);
            ?>
          </select>
          <button id="button" type="button" onclick="pesquisar_atletas()">Pesquisar</button><br><br>
          <div id="lista_atletas">

          </div>
          <script type="text/javascript">
            pesquisar_atletas();
          </script>
        </div>
      </div>
    </div>
  </body>
</html>
