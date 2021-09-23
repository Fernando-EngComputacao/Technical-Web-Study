<!DOCTYPE html>
<?php
  include 'session.php';
  include '../conexao.php';

  if(isset($_GET['i'])){

    $msg = 0;
    $id = $_GET['i'];


    $sql = "select prova.id from prova, modalidade where prova.modalidade_id = modalidade.id and modalidade.id = ?;";
    $stmt = mysqli_prepare($conexao,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$a);
    mysqli_stmt_store_result($stmt);
    $qtd = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);

    if($qtd == 0){
          echo $id;
          $sql = "delete from modalidade where id = ?;";
          $stmt = mysqli_prepare($conexao,$sql);
          mysqli_stmt_bind_param($stmt,'i',$id);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);
          header("Location: gerenciar_modalidades.php");
    }
    else {
      header("Location: alterar_modalidade.php?i=$id&er=1");
  }}
?>
