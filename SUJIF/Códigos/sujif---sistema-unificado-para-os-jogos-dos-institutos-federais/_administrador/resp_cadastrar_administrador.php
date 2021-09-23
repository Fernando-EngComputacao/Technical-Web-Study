<?php
  include 'session.php';
  include '../conexao.php';
  $msg = 0;
  echo "oi";
  if(isset($_POST['i'])){
    $nome = trim($_POST['nome']);
    $cpf = $_POST['cpf'];
    $email = trim($_POST['email']);
    $senha1 = trim($_POST['senha1']);
    $senha2 = trim($_POST['senha2']);

    //validando Dados
    if($nome == "" || $cpf == "" || $email == ""){
      $msg = 1;
      //Dados Inválidos
    }
    else if(strlen($senha1) < 8 || $senha1 != $senha2){
      $msg = 2;
      //Senhas desiguais ou menores que 8 caracteres
    }
    else{
      //Cadastrar Administrador
      if ($_POST['i'] == 0) {
        include 'session_master.php';
        $sql = "insert into administrador(id,nome,cpf,email,senha,status,competicao_id) values(null,?,?,?,?,1,?);";
        $stmt = mysqli_prepare($conexao,$sql);
        mysqli_stmt_bind_param($stmt,'ssssi',$nome,$cpf,$email,sha1($senha1),$_SESSION['sujif']['competicao']);
      }
      else{
        $id = $_POST['i'];
        $sql = "update administrador set nome = ?, cpf = ?, email = ?, senha = ? where id = ?;";
        $stmt = mysqli_prepare($conexao,$sql);
        mysqli_stmt_bind_param($stmt,'ssssi',$nome,$cpf,$email,sha1($senha1),$id);
      }

      if(mysqli_stmt_execute($stmt)){
        $msg = 3;
        //cadastrado com sucesso.
      }
      else{
        $msg = 4;
        //Erro no cadastro.
      }
      mysqli_stmt_close($stmt);
    }
    header("Location: cadastrar_administrador.php?msg=$msg");
  }
?>
