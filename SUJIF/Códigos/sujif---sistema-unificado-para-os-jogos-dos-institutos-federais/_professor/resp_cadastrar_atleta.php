<?php
  include 'session.php';

  if(isset($_POST['i'])){
    include 'carregar_img.php';
    include '../conexao.php';
    $msg = 0;
    $id = $_POST['i'];
    $sexo = $_POST['sexo'];
    $nome = trim($_POST['nome']);
    $data_nasc = $_POST['data_nasc'];
    $cpf = trim($_POST['cpf']);
    $rg = trim($_POST['rg']);
    $result_names = [];
    $imgs = [['foto_perfil','foto_rg','foto_cpf'],['../foto_perfil','../foto_rg','../foto_cpf']];
    for ($i=0; $i < sizeof($imgs[0]); $i++) {
      $img = $imgs[0][$i];
      $result = upload($_FILES[$img]['tmp_name'], $_FILES[$img]['name'], 400, 300, $imgs[1][$i]);
      // echo $result . "<br><hr>";
      if($result == -1){
        $msg = 1;
        //imagem inválida
      }
      else{
        $result_names[] = $result;
      }
    }
    if($msg == 0){
      if($id == 0){
        $sql = "insert into atleta(id,nome,data_nascimento,cpf,rg,foto_aluno,foto_rg,foto_cpf,professor_id,sexo) values(null,?,?,?,?,?,?,?,?,?);";
        $stmt = mysqli_prepare($conexao,$sql);
        mysqli_stmt_bind_param($stmt,"sssssssii",$nome,$data_nasc,$cpf,$rg,$result_names[0],$result_names[1],$result_names[2],$_SESSION['sujif']['id'],$sexo);
        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_close($stmt);
          $sql = "select atleta.id from atleta,professor,competicao where atleta.professor_id = professor.id and professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) and atleta.cpf = ? and atleta.rg = ?;";
          $stmt = mysqli_prepare($conexao,$sql);
          mysqli_stmt_bind_param($stmt,'ss',$cpf,$rg);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$id);
          mysqli_stmt_fetch($stmt);
          header("Location: vincular_provas.php?i=$id");
        }
        else{
          $msg = 2;;
          //error
        }
      }
      else{
        $sql = "update atleta set nome = ?, data_nascimento = ?, cpf = ?, rg = ?, sexo = ? where id = ?;";
        $stmt = mysqli_prepare($conexao,$sql);
        mysqli_stmt_bind_param($stmt,'ssssii',$nome,$data_nasc,$cpf,$rg,$sexo,$id);
        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_close($stmt);

          $imgs = ['foto_aluno','foto_rg','foto_cpf'];
          for ($i=0; $i < sizeof($imgs); $i++) {
            if ($result_names[$i] != -2) {
              $img = $imgs[$i];
              $sql = "update atleta set $img = ? where id = ?;";
              echo "<hr>$sql";
              $stmt = mysqli_prepare($conexao,$sql);
              mysqli_stmt_bind_param($stmt,'si',$result_names[$i],$id);
              mysqli_stmt_execute($stmt);
              mysqli_stmt_close($stmt);
            }
          }
          header("Location: visualizar_atleta.php?i=$id");
        }
        else{
          $msg = 2;
          //error
        }

          //perfil, rg, cpf

      }
    }
    if($msg != 0){
      header("Location: cadastrar_atleta.php?msg=$msg");
    }
  }
  else{
    header("Location: menu.php");
  }
?>
