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
    $sql = "select modalidade.nome, modalidade.descricao from modalidade, competicao where modalidade.id = ? and modalidade.competicao_id = competicao.id and competicao.id = (select max(id) from competicao);";
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
  }
  else{
    $id = 0;
    $nome = "";
    $descricao = "";
  }
?>
<html>
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
      <h2>Cadastrar Modalidade</h2>
      <form class="formulario" action="resp_cadastrar_modalidade.php" method="post">
        <input type="hidden" name="i" value="<?php echo $id; ?>">
        <span>Nome</span> <input type="text" name="nome" placeholder="Insira o nome da modalidade..." value='<?php echo $nome; ?>'><br><br>
        <span>Descrição</span> <textarea name='descricao'><?php echo $descricao; ?></textarea><br><br>
        <input type="submit" value="Cadastrar">
      </form>
    </div>
  </body>
</html>
