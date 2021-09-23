<?php
  include 'session.php';

  if(!isset($_POST['pesq']) || !isset($_POST['professor'])){
    header("Location: menu.php");
  }
  $pesq = trim($_POST['pesq']);
  $professor = $_POST['professor'];
  echo '
  <table>
    <tr class="titulo">
      <td>Nome</td><td>CPF</td><td>RG</td><td>Data de Nascimento</td><td>Professor</td><td>Visualizar</td><td>Alterar Dados</td>
    </tr>
  ';
  include '../conexao.php';
  $pesq = "$pesq%";

  if($professor == 0){
    $professor = $_SESSION['sujif']['id'];
    $sql = "select atleta.id, atleta.nome, atleta.cpf, atleta.rg, atleta.data_nascimento, professor.nome from atleta, professor, campus where campus.id = professor.campus_id and atleta.professor_id = professor.id and professor.id != ? and atleta.nome like ? and campus.id = ?;";
  }
  else{
    $sql = "select atleta.id, atleta.nome, atleta.cpf, atleta.rg, atleta.data_nascimento, professor.nome from atleta, professor, campus where campus.id = professor.campus_id and atleta.professor_id = professor.id and professor.id = ? and atleta.nome like ? and campus.id = ?;";
  }
  $stmt = mysqli_prepare($conexao,$sql);
  mysqli_stmt_bind_param($stmt,'isi',$professor,$pesq,$_SESSION['sujif']['campus']);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt,$id,$nome,$cpf,$rg,$data_nasc,$professor);
  mysqli_stmt_store_result($stmt);
  if(mysqli_stmt_num_rows($stmt) > 0){
    while (mysqli_stmt_fetch($stmt)) {
      echo "<tr><td>$nome</td><td>$cpf</td><td>$rg</td><td>$data_nasc</td><td>$professor</td>";
      echo "<td><a href='visualizar_atleta.php?i=$id'><img class='icon' src='../_imagens/icon_lupa.png' alt='VISUALIZAR'></a></td>";
      echo "<td><a href='cadastrar_atleta.php?i=$id'><img class='icon' src='../_imagens/icon_atualizar.png' alt='EDITAR'></a></td></tr>";
    }
  }
  else{
    echo "<tr><td colspan='7'>Nenhum aluno encontrado</td></tr>";
  }
  echo "</table>";
?>
