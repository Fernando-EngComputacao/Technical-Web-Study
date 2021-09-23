<?php
  include 'session.php';

  if(isset($_POST['i'])){
    $id = $_POST['i'];
    include "../conexao.php";
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);

    if($id == 0){
      $sql = "insert into modalidade(id, nome, descricao, competicao_id) values(null,?,?, (select max(id) from competicao));";
      $stmt = mysqli_prepare($conexao, $sql);
      mysqli_stmt_bind_param($stmt,'ss',$nome,$descricao);
    }
    else{
      $sql = "update modalidade set nome = ?, descricao = ? where id = ?;";
      $stmt = mysqli_prepare($conexao, $sql);
      mysqli_stmt_bind_param($stmt,'ssi',$nome,$descricao,$id);
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if($id == 0){
      header("Location: cadastrar_prova.php");
    }
    else{
      header("Location: alterar_modalidade.php?i=$id");
    }
  }
  else{
    header("Location: menu.php");
  }

?>
