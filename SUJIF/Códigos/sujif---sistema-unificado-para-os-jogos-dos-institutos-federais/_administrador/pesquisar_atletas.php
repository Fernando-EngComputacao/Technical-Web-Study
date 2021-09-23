<?php
  include 'session.php';

  if(!isset($_POST['pesq']) || !isset($_POST['campus'])){
    header("Location: menu.php");
  }
  $pesq = trim($_POST['pesq']);
  $campus = $_POST['campus'];
  echo '
  <table>
    <tr class="titulo">
      <td>Aluno</td><td>CPF</td><td>RG</td><td>Data de Nascimento</td><td>Professor</td><td>E-mail do professor</td><td>Telefone do professor</td><td>Campus</td><td>Visualizar Dados</td>
    </tr>
  ';
  include '../conexao.php';
  $pesq = "$pesq%";

  if($campus == 0){
    $sql = "select atleta.id, atleta.nome, atleta.data_nascimento, atleta.cpf, atleta.rg, professor.nome, professor.email, professor.telefone, campus.nome, campus.sigla, campus.uf from campus, competicao, atleta, professor where campus.id = professor.campus_id and campus.id != ? and professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) and atleta.professor_id = professor.id and atleta.nome like ? order by professor.nome asc;";
  }
  else{
    $sql = "select atleta.id, atleta.nome, atleta.data_nascimento, atleta.cpf, atleta.rg, professor.nome, professor.email, professor.telefone, campus.nome, campus.sigla, campus.uf from campus, competicao, atleta, professor where campus.id = professor.campus_id and campus.id = ? and professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) and atleta.professor_id = professor.id and atleta.nome like ? order by professor.nome asc;";
  }
  $stmt = mysqli_prepare($conexao,$sql);
  mysqli_stmt_bind_param($stmt,'is',$campus,$pesq);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt,$id,$atleta,$data_nasc,$cpf,$rg,$professor,$email_prof,$telefone_prof,$campus,$sigla,$uf);
  mysqli_stmt_store_result($stmt);
  if(mysqli_stmt_num_rows($stmt) > 0){
    while (mysqli_stmt_fetch($stmt)) {
      echo "<tr><td>$atleta</td><td>$cpf</td><td>$rg</td><td>$data_nasc</td><td>$professor</td><td>$email_prof</td><td>$telefone_prof</td><td>$campus - $sigla ($uf)</td>";
      echo "<td><a href='visualizar_atleta.php?i=$id'><img class='icon' src='../_imagens/icon_lupa.png' alt='VISUALIZAR'></a></td></tr>";
    }
  }
  else{
    echo "<tr><td colspan='9'>Nenhum aluno encontrado</td></tr>";
  }
  echo "</table>";
?>
