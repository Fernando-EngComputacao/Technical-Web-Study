<?php
  include 'session.php';

  if(!isset($_POST['pesq'])){
    header("Location: menu.php");
  }
  $pesq = trim($_POST['pesq']);

  include '../conexao.php';
  $sql = "select atleta.id, atleta.nome, atleta.cpf, atleta.rg, atleta.data_nascimento from atleta, professor where atleta.professor_id = professor.id and professor.id = ? and atleta.nome like ?;";
  $stmt = mysqli_prepare($conexao,$sql);
  $pesq = "$pesq%";
  mysqli_stmt_bind_param($stmt,'is',$_SESSION['sujif']['id'],$pesq);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt,$id,$nome,$cpf,$rg,$data_nasc);
  mysqli_stmt_store_result($stmt);
  echo '
  <table>
  <tr class="titulo">
  <td>Nome</td><td>CPF</td><td>RG</td><td>Data de Nascimento</td><td>Visualizar</td><td>Alterar Dados</td><td>Exluir</td>
  </tr>
  ';
  if(mysqli_stmt_num_rows($stmt) > 0){
    while (mysqli_stmt_fetch($stmt)) {
      echo "<tr><td>$nome</td><td>$cpf</td><td>$rg</td><td>$data_nasc</td>";
      echo "<td><a href='visualizar_atleta.php?i=$id'><img class='icon' src='../_imagens/icon_lupa.png' alt='VISUALIZAR'></a></td>";
      echo "<td><a href='cadastrar_atleta.php?i=$id'><img class='icon' src='../_imagens/icon_atualizar.png' alt='EDITAR'></a></td>";
      echo "<td><a href='excluir_atleta.php?i=$id'><img class='icon' src='../_imagens/icon_apagar.png' alt='APAGAR'></a></td></tr>";
    }
  }
  else{
    echo "<tr><td colspan='7'>Nenhum atleta cadastrado por você encontrado, deseja <a href='cadastrar_atleta.php'>cadastrar?</a></td></tr>";
  }
  echo "</table>";
  mysqli_stmt_close($stmt);
?>
