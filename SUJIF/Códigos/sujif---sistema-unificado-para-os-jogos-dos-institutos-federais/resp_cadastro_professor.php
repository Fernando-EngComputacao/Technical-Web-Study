<?php
  if(!isset($_POST['num_suap'])){
    header("Location: index.php");
  }
  $msg = 0;
  $id = $_POST['i'];
  echo $id."<hr>";
  $nome = trim($_POST['nome']);
  $cpf = $_POST['cpf'];
  $rg = trim($_POST['rg']);
  $telefone = trim($_POST['telefone']);
  $email = trim($_POST['email']);
  $senha1 = trim($_POST['senha1']);
  $senha2 = trim($_POST['senha2']);
  $num_suap = trim($_POST['num_suap']);
  $campus = trim($_POST['campus']);
  include 'conexao.php';

  if($campus == -1){
    //Nenhum Campus Selecionado
    $msg = 1;
  }
  else if (strlen($senha1) < 8 || $senha1 != $senha2) {
    //Senha desiguais ou menores que 8 caracteres
    $msg = 3;
  }
  else if($nome == "" || strlen($cpf) != 14 || $rg == "" || $telefone == "" || $email == "" || $num_suap == ""){
    //dados Inválidos
    $msg = 4;
  }
  else{
    if($campus == 0 && $msg == 0){
      $nome_campus = $_POST['nome_campus'];
      $sigla_campus = $_POST['sigla_campus'];
      $uf = $_POST['estado'];
      $sql = "insert into campus(id, nome, sigla, uf) values(null,?,?,?);";
      $stmt = mysqli_prepare($conexao,$sql);
      mysqli_stmt_bind_param($stmt,"sss",$nome_campus,$sigla_campus,$uf);
      if(!mysqli_stmt_execute($stmt)){
        //erro no cadastro
        $msg = 2;
      }
      mysqli_stmt_close($stmt);
      //pegando id do campus cadastrados
      $sql = "select max(id) as id from campus;";
      $result = mysqli_query($conexao,$sql);
      $campus = mysqli_fetch_array($result)['id'];
    }
    if($msg == 0){
      if($id == 0){
        //pegando o id da ultima competicao
        $sql = "select max(id) as id from competicao;";
        $result = mysqli_query($conexao,$sql);
        $competicao_id = mysqli_fetch_array($result)['id'];

        $sql = "insert into professor(id, nome, cpf, rg, telefone, email, senha, num_suap, status, campus_id, competicao_id) values(null,?,?,?,?,?,?,?,2,?,?);";
        $stmt = mysqli_prepare($conexao,$sql);
        mysqli_stmt_bind_param($stmt,'sssssssii',$nome,$cpf,$rg,$telefone,$email,sha1($senha1),$num_suap,$campus,$competicao_id);
        if(!mysqli_stmt_execute($stmt)){
          //erro no cadastro
          $msg = 2;
        }
        mysqli_stmt_close($stmt);
        header("Location: cadastro_professor.php?msg=$msg");
      }
      else{
        $sql = "update professor set nome = ?, cpf = ?, rg = ?, telefone = ?, email = ?, senha = ?, num_suap = ? where id = ?;";
        $stmt = mysqli_prepare($conexao,$sql);
        mysqli_stmt_bind_param($stmt,'sssssssi',$nome,$cpf,$rg,$telefone,$email,sha1($senha1),$num_suap,$id);
        if(!mysqli_stmt_execute($stmt)){
          //erro no cadastro
          $msg = 2;
        }
        mysqli_stmt_close($stmt);
        header("Location: cadastro_professor.php?msg=$msg&i=$id");
      }
    }
  }
?>
