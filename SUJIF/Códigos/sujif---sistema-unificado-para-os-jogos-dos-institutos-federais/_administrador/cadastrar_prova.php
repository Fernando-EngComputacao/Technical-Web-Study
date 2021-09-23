<!DOCTYPE html>
<?php
  include "session.php";

  function master($codigo) {
      if($_SESSION['sujif']['master'] == 0){
          echo $codigo;
      }
  }

  if(isset($_GET['i'])){
    $id = $_GET['i'];
    include '../conexao.php';
    $sql = "select nome, tipo, qtd_max_atleta, descricao, modalidade_id from prova where id = ?;";
    $stmt = mysqli_prepare($conexao,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$nome,$tipo,$qtd_max_atletas,$descricao,$modalidade);
    mysqli_stmt_store_result($stmt);
    if(mysqli_stmt_num_rows($stmt) == 0){
      // header("Location: menu.php");
    }
    else{
      mysqli_stmt_fetch($stmt);
      mysqli_stmt_close($stmt);
    }
  }
  else {
    $id = 0;
    $nome = "";
    $tipo = 0;
    $qtd_max_atletas = "";
    $descricao = "";
    $modalidade = 0;
  }
  if(isset($_GET['im'])){
    $modalidade = $_GET['im'];
  }
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>SUJIF - Sistema Unificado para os Jogos dos Institutos Federais</title>
    <link rel="stylesheet" type="text/css" href="../_css/master.css">
    <script type="text/javascript" src="../_js/sidenav.js"></script>
    <script type="text/javascript" src="../_js/jquery_3-3-1.js"></script>
  </head>
  <body>
      <?php include "../cabecalho.php"; ?>

    <div class="content col-9">
      <h2>Cadastrar Prova</h2>
      <form class="formulario" action="resp_cadastrar_prova.php" method="post">
        <input type="hidden" name="i" value="<?php echo $id ?>">

        <span>Nome</span><br> <input type="text" name="nome" value="<?php echo $nome; ?>"><br><br>
        <span>Descrição</span><br> <textarea name='descricao'><?php echo $descricao; ?></textarea><br><br>
        <span>Número máximo de atletas</span><br> <input type="number" name="max_atletas" value="<?php echo $qtd_max_atletas; ?>"><br><br>
        <span>Tipo</span><br> <select name="tipo">
          <?php
            if($tipo == 0){
              echo '<option value="0">Individual</option><option value="1">Coletivo</option>';
            }
            else if($tipo == 1){
              echo '<option value="1">Coletivo</option><option value="0">Individual</option>';
            }
          ?>
      </select><br><br>


          <?php
            if($modalidade == 0){
              include "../conexao.php";
              echo '<span>Modalidade</span><br><select name="modalidade">';
              $sql = "select id, nome from modalidade where competicao_id = (select max(id) from competicao);";

              $resultado = mysqli_query($conexao, $sql);

              while ($linha = mysqli_fetch_array($resultado)) {

                echo "<option value='" . $linha["id"] . "'>" . $linha['nome'] . "</option>";
              }
              echo '</select><br>';
            }
            else{
              echo "<input type='hidden' name='modalidade' value='$modalidade'><br>";
            }
           ?>

        <br>
        <input type="submit" value="Cadastrar">

      </form>
    </div>
  </body>
</html>
