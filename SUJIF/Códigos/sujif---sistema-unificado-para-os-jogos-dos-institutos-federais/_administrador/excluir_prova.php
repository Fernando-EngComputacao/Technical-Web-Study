<!DOCTYPE html>
<?php
  include 'session.php';

  $m = $_GET['m'];

  if(isset($_GET['i'])){
    $msg = 0;
    $id = $_GET['i'];
    include '../conexao.php';
    $sql = "select competidor.atleta_id from competidor, prova where competidor.prova_id = prova.id and prova.id = ?;";
    $stmt = mysqli_prepare($conexao,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$a);
    mysqli_stmt_store_result($stmt);
    $qtd = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);

    if($qtd == 0){
          $sql = "delete from prova where id = ?;";
          $stmt = mysqli_prepare($conexao,$sql);
          mysqli_stmt_bind_param($stmt,'i',$id);
          mysqli_stmt_execute($stmt);
          header("Location: alterar_modalidade.php");
    }
    else{
        header("Location: alterar_modalidade.php?i=$m&er=2");
      //Operacoa invalida
  }}
?>
