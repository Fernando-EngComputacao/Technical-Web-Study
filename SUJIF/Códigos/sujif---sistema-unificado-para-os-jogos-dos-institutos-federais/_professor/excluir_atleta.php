<!DOCTYPE html>
<?php
  include 'session.php';

  if(isset($_GET['i'])){
    $msg = 0;
    $id = $_GET['i'];
    include '../conexao.php';
    $sql = "select competidor.atleta_id from competidor, atleta where competidor.atleta_id = atleta.id and atleta.id = ?;";
    $stmt = mysqli_prepare($conexao,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$a);
    mysqli_stmt_store_result($stmt);
    $qtd = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);

    if($qtd == 0){
          echo $id;
          $sql = "delete from atleta where id = ?;";
          $stmt = mysqli_prepare($conexao,$sql);
          mysqli_stmt_bind_param($stmt,'i',$id);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);
          header("Location: gerenciar_atletas.php");
      }

      else {
          header("Location: gerenciar_atletas.php?er=1");
      }
    }
?>
