<?php
  if(isset($_POST['email'])){

    include 'conexao.php';
    //Selecionando a ultima competicao, a aberta
    $sql = "select max(id) as id from competicao;";
    $result = mysqli_query($conexao,$sql);
    $competicao_id = mysqli_fetch_array($result)['id'];

    $email = $_POST['email'];
    $senha = sha1($_POST['senha']);
    $tipo = $_POST['tipo'];
    if($tipo == 1){
      //Professor
      $sql = "select professor.id as id_professor, professor.nome as nome_professor, professor.campus_id, competicao.data_encerramento > now() as atual from professor, competicao where professor.competicao_id = competicao.id and competicao.id = ? and professor.email = ? and professor.senha = ? and professor.status = 1;";
      $stmt = mysqli_prepare($conexao,$sql);
      mysqli_stmt_bind_param($stmt,'iss',$competicao_id,$email,$senha);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt,$id,$nome,$campus,$atual);
      mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt) == 1){
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        if($atual == 1){
          session_start();
          $_SESSION['sujif']['id'] = $id;
          $_SESSION['sujif']['nome'] = $nome;
          $_SESSION['sujif']['tipo'] = $tipo;
          $_SESSION['sujif']['campus'] = $campus;
          $_SESSION['sujif']['competicao'] = $competicao_id;
          header("Location: _professor/menu.php");
        }
        else{
          header("Location: login.php?q=error");
        }
      }
      else{
        header("Location: login.php?q=error");
      }
    }
    else if($tipo == 0){
      //Administrador
      $cpf = $_POST['cpf'];
      $sql = "select administrador.id as id_administrador, administrador.nome as nome_administrador, competicao.data_encerramento > now() as atual, administrador.status from administrador, competicao where administrador.competicao_id = competicao.id and competicao.id = ? and administrador.email = ? and administrador.senha = ? and cpf = ? and status != 2;";
      $stmt = mysqli_prepare($conexao,$sql);
      mysqli_stmt_bind_param($stmt,'isss',$competicao_id,$email,$senha,$cpf);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt,$id,$nome,$atual,$status);
      mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt) == 1){
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        if($atual == 1 || $status == 0){
          session_start();
          $_SESSION['sujif']['master'] = 1;
          if($status == 0){
            $_SESSION['sujif']['master'] = 0;
          }
          $_SESSION['sujif']['id'] = $id;
          $_SESSION['sujif']['nome'] = $nome;
          $_SESSION['sujif']['tipo'] = $tipo;
          $_SESSION['sujif']['competicao'] = $competicao_id;
          header("Location: _administrador/menu.php");
        }
        else{
          echo $atual;
          // header("Location: login.php?q=error");
        }
      }
      else{
        header("Location: login.php?q=error");
      }
    }
    else{
      header("Location: login.php");
    }
  }
  else{
    header("Location: login.php");
  }
?>
