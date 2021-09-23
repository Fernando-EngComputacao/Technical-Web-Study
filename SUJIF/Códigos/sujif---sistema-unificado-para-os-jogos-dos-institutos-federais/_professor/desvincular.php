<?php
  include 'session.php';
  if(isset($_GET['i']) && isset($_GET['p'])){
    $id = $_GET['i'];
    $p = $_GET['p'];
    include '../conexao.php';
    $modalidade = $_GET['m'];
    $sql = "delete from competidor where prova_id = ? and atleta_id = ?;";
    $stmt = mysqli_prepare($conexao,$sql);
    mysqli_stmt_bind_param($stmt,'ii',$p,$id);
    mysqli_stmt_execute($stmt);

    header("Location: visualizar_atleta.php?i=$id");
    }else{
        header("Location: menu.php");
      }
?>
