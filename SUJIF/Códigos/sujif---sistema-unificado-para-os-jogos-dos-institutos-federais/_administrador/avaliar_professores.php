<!DOCTYPE html>
<?php
  include 'session.php';

    function master($codigo) {
        if($_SESSION['sujif']['master'] == 0){
            echo $codigo;
        }
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Seja bem vindo ao SUJIF</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../_css/master.css">
        <script type="text/javascript" src="../_js/sidenav.js"></script>
        <script type="text/javascript" src="../_js\avaliar_professores.js"></script>
        <script src="../_js/jquery_3-3-1.js"></script>
    </head>

    <body>
        <?php include '../cabecalho.php'; ?>

        <div class="content col-9 avl_professores">
            <h2>Gerenciar Professores</h2><hr><br>
              <input type="text" id="pesq" placeholder="Pesquisa..." maxlength="60" value="">
              <select id="pesq_campus">
                <option value="-1">Todos os campus cadastrados</option>
                <?php
                  include '../conexao.php';
                  $sql = "select campus.id, campus.nome, campus.sigla, campus.uf from campus, professor, competicao where campus.id = professor.campus_id and professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) group by campus.nome order by campus.nome asc;";
                  $stmt = mysqli_prepare($conexao,$sql);
                  mysqli_stmt_execute($stmt);
                  mysqli_stmt_bind_result($stmt,$id,$nome,$sigla,$uf);
                  mysqli_stmt_store_result($stmt);
                  if (mysqli_stmt_num_rows($stmt) > 0) {
                    while(mysqli_stmt_fetch($stmt)){
                      echo "<option value='$id'>$nome - $sigla ($uf)</option>";
                    }
                  }
                  mysqli_stmt_close($stmt);
                ?>
              </select>
              <button type="button" id="button" onclick="pesquisar_professor()">Pesquisar</button>
              <div id="professores">

              </div>
        </div>
        <script type="text/javascript">pesquisar_professor();</script>
    </body>
</html>

<!-- <!DOCTYPE html>
<?php
  include 'session.php';
?>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SUJIF - Sistema Unificado para os Jogos dos Institutos Federais</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../_js\avaliar_professores.js"></script>
  </head>
  <body>
    <div class="pagina">
      <input type="text" id="pesq" placeholder="Pesquisa..." maxlength="60" value="">
      <select id="pesq_campus">
        <option value="-1">Todos os campus cadastrados</option>
        <?php
          include '../conexao.php';
          $sql = "select campus.id, campus.nome, campus.sigla, campus.uf from campus, professor, competicao where campus.id = professor.campus_id and professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) group by campus.nome order by campus.nome asc;";
          $stmt = mysqli_prepare($conexao,$sql);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$id,$nome,$sigla,$uf);
          mysqli_stmt_store_result($stmt);
          if (mysqli_stmt_num_rows($stmt) > 0) {
            while(mysqli_stmt_fetch($stmt)){
              echo "<option value='$id'>$nome - $sigla ($uf)</option>";
            }
          }
          mysqli_stmt_close($stmt);
        ?>
      </select>
      <button type="button" id="button" onclick="pesquisar_professor()">Pesquisar</button>
      <div id="professores">

      </div>
    </div>
  </body>
  <script type="text/javascript">
    pesquisar_professor();
  </script>
</html> -->
