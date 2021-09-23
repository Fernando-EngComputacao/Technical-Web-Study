<!DOCTYPE html>
<?php
  include 'session_master.php';

    $id = $_GET['i'];

      $id = $_GET['i'];
      include '../conexao.php';
      $sql = "update administrador set status = 2 where id = ?;";
      $stmt = mysqli_prepare($conexao,$sql);
      mysqli_stmt_bind_param($stmt,'i',$id);
      mysqli_stmt_execute($stmt);
      header("Location: gerenciar_administradores.php");
?>
