<?php
  include 'session.php';

  if(isset($_POST['i'])){
    $id = $_POST['i'];
    $nome = trim($_POST['nome']);
    $tipo = $_POST['tipo'];
    $qtd_max_atletas = trim($_POST['max_atletas']);
    $descricao = trim($_POST['descricao']);
    $modalidade = $_POST['modalidade'];
    include "../conexao.php";
    if($id == 0){
      $sql = "insert into prova(id, nome, tipo, qtd_max_atleta, descricao, modalidade_id) values(null, ?,?,?,?,?);";
      $stmt = mysqli_prepare($conexao, $sql);
      mysqli_stmt_bind_param($stmt,'siisi',$nome,$tipo,$qtd_max_atletas,$descricao,$modalidade);
    }
    else{
      $sql = "update prova set nome = ?, tipo = ?, qtd_max_atleta = ?, descricao = ? where id = ?;";
      $stmt = mysqli_prepare($conexao,$sql);
      mysqli_stmt_bind_param($stmt,'siisi',$nome,$tipo,$qtd_max_atletas,$descricao,$id);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: alterar_modalidade.php?i=$modalidade");
  }
  else{
    header("Location: menu.php");
  }
?>
