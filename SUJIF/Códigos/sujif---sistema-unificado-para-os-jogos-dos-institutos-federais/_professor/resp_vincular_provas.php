<?php
  include "session.php";

  if(isset($_POST['i'])){
    $id = $_POST['i'];
    $provas = $_POST['provas'];
    include '../conexao.php';
    $sql = "select lim_modalidade_atleta as limite from competicao where id = (select max(id) from competicao);";
    $qtd = mysqli_fetch_array(mysqli_query($conexao,$sql))['limite'];
    if(sizeof($provas) <= $qtd){

      $sql = "select count(competidor.prova_id) from competidor, atleta, professor, competicao where professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) and atleta.professor_id = professor.id and atleta.id = competidor.atleta_id and atleta.id = ?;";
      $stmt = mysqli_prepare($conexao,$sql);
      mysqli_stmt_bind_param($stmt,'i',$id);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt,$inscrito);
      mysqli_stmt_fetch($stmt);
      mysqli_stmt_close($stmt);

      if($inscrito > 0){
        $sql = "delete from competidor where competidor.atleta_id = ?;";
        $stmt = mysqli_prepare($conexao,$sql);
        mysqli_stmt_bind_param($stmt,'i',$id);
        if(!mysqli_stmt_execute($stmt)){
          header("Location: menu.php");
        }
        mysqli_stmt_close($stmt);
      }

      $sql = "insert into competidor(prova_id,atleta_id) values(?,?);";
      for ($i=0; $i < sizeof($provas); $i++) {
        $stmt = mysqli_prepare($conexao,$sql);
        mysqli_stmt_bind_param($stmt,"ii",$provas[$i],$id);
        mysqli_stmt_execute($stmt);
      }
      header("Location: visualizar_atleta.php?i=$id");
    }
    else{
      $msg = 1;
      //limite de modalidade para o atleta exedidos
      header("Location: vincular_provas.php?i=$id&msg=$msg");
    }
  }
  else{
    header("Location: menu.php");
  }
?>
