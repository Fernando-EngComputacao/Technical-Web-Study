<?php
  include 'session_master.php';
  if(isset($_POST['pesq'])){
    $pesq = ucwords(strtolower($_POST['pesq']));
    include '../conexao.php';

    //Seleciona a ultima competicao
    $sql = "select max(id) as id from competicao;";
    $result = mysqli_query($conexao,$sql);
    $competicao_id = mysqli_fetch_array($result)['id'];

      echo "<table>";
      // echo "<tr>";
      // echo "<td class='titulo' colspan='6'>Adminstradores cadastrados nessa competicao</td>";
      // echo "</tr>";
      echo "<tr class='titulo'>";
      echo "<td>Nome</td>";
      echo "<td>CPF</td>";
      echo "<td>E-mail</td>";
      echo "<td>Competição</td>";
      echo "<td>Alterar</td>";
      echo "<td>Deletetar</td>";
      echo "</tr>";

    if ($pesq == ""){
      $sql = "select administrador.id, administrador.nome, administrador.cpf, administrador.email, competicao.nome as competicao, competicao.data_abertura, competicao.data_encerramento from competicao, administrador where administrador.competicao_id = competicao.id and competicao_id = ? and administrador.status = 1;";
      $stmt = mysqli_prepare($conexao,$sql);
      mysqli_stmt_bind_param($stmt,'i',$competicao_id);
    }
    else{
      $sql = "select administrador.id, administrador.nome, administrador.cpf, administrador.email, competicao.nome as competicao, competicao.data_abertura, competicao.data_encerramento from competicao, administrador where administrador.competicao_id = competicao.id and competicao.id = ? and administrador.nome like ? and administrador.status = 1;";
      $stmt = mysqli_prepare($conexao,$sql);
      $pesq = $pesq."%";
      mysqli_stmt_bind_param($stmt,'is',$_SESSION['sujif']['competicao'],$pesq);
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$id,$nome,$cpf,$email,$competicao,$abertura,$encerramento);
    mysqli_stmt_store_result($stmt);
    if(mysqli_stmt_num_rows($stmt) > 0){
      while (mysqli_stmt_fetch($stmt)) {
        echo "<tr><td>$nome</td><td>$cpf</td><td>$email</td><td>$competicao ($abertura - $encerramento)</td>";
        echo "<td><a href='cadastrar_administrador.php?i=$id'><img class='icon' src='../_imagens/icon_atualizar.png' alt='ATUALIZAR'></a></td>";
        echo "<td><a href='deletar_administrador.php?i=$id'><img class='icon' src='../_imagens/icon_apagar.png' alt='DELETAR'></a></td>";
      }
    }
    else{
      echo "<tr><td colspan='6'>Nenhum administrador cadastrado nessa competição</td></tr>";
    }
    mysqli_stmt_close($stmt);
  }
?>
