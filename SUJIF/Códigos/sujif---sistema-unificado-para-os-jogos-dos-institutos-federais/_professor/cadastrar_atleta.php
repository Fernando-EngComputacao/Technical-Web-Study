<!DOCTYPE html>
<?php
  include 'session.php';

  function master($codigo) {
      if($_SESSION['sujif']['master'] == 0){
          echo $codigo;
      }
  }

  if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
  }
  else{
    $msg = 0;
  }
  if(isset($_GET['i'])){
    $id = $_GET['i'];
    include '../conexao.php';
    $sql = "select atleta.nome, atleta.data_nascimento, atleta.cpf, atleta.rg, atleta.foto_aluno, atleta.foto_cpf, atleta.foto_rg, atleta.sexo from atleta, professor, competicao, campus where competicao.id = professor.competicao_id and competicao.id = (select max(id) from competicao) and campus.id = professor.campus_id and campus.id = ? and atleta.professor_id = professor.id and atleta.id = ?;";
    $stmt = mysqli_prepare($conexao,$sql);
    mysqli_stmt_bind_param($stmt,'ii',$_SESSION['sujif']['campus'],$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$nome,$data_nasc,$cpf,$rg,$foto_perfil,$foto_cpf,$foto_rg, $sexo);
    mysqli_stmt_store_result($stmt);
    if(mysqli_stmt_num_rows($stmt) != 1){
      header("Location: menu.php");
    }
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
  }
  else{
    $id = 0;
    $nome = "";
    $data_nasc = "";
    $cpf = "";
    $rg = "";
    $foto_perfil = "";
    $foto_cpf = "";
    $foto_rg = "";
    $sexo = 0;
  }
?>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SUJIF - Sistema Unificado para os Jogos dos Institutos Federais</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../_css/master.css">
    <script src="../_js/jquery_3-3-1.js"></script>
    <script type="text/javascript" src="../_js/sidenav.js"></script>
    <script src="../_js/input_cpf.js" charset="utf-8"></script>
    <script src="../_js/exibir_img.js" charset="utf-8"></script>
  </head>
  <body>
      <?php include "../cabecalho_professor.php"; ?>

    <div class="content col-9">
      <h2>Cadastrar Atleta</h2>
        <?php
          if($msg != 0){
            echo '<div class="msg">';
            if($msg == 1){
              echo "Imagem Inválidas";
            }
            else if($msg == 2){
              echo "Error";
            }
            echo '</div>';
          }
        ?>
      <form class="formulario" action="resp_cadastrar_atleta.php" method="post" enctype="multipart/form-data"><br>
        <input type="hidden" name="i" value="<?php echo $id; ?>">
        <span>Nome:</span><input type="text" name="nome" placeholder="Insira seu nome..." maxlength="60" required value="<?php echo $nome; ?>"><br><br>
        <span>Data de Nascimento:</span><br><input type="date" name="data_nasc" placeholder="Insira sua data de nacimento..." required maxlength="10" value="<?php echo $data_nasc; ?>"><br><br>
        <span>CPF:</span><input type="text" name="cpf" placeholder="Insira seu CPF..." maxlength="14" value="<?php echo $cpf; ?>" required onkeydown="javascript: fMasc( this, mCPF );"><br><br>
        <span>RG:</span><input type="text" name="rg" placeholder="Insira seu RG..." maxlength="7" required value="<?php echo $rg; ?>"><br><br>
        <span>Sexo:</span><select class="select" name="sexo">
        <?php
          if($sexo == 2){
            echo '
            <option value="2">Feminino</option>
            <option value="1">Masculino</option>
            ';
          }
          else{
            echo '
            <option value="1">Masculino</option>
            <option value="2">Feminino</option>
            ';
          }
        ?>
      </select><br><br>
        <?php
          if($foto_perfil != ""){
            echo "<a href='../$foto_perfil' download><img class='foto' src='../$foto_perfil' alt='FOTO DO ALUNO'></a><br>";
          }
        ?>
        <span>Foto do aluno: </span>
        <input type="file" <?php if($id == 0){echo 'required';} ?> name="foto_perfil"><br><br>

        <?php
          if($foto_cpf != ""){
            echo "<a href='../$foto_cpf' download><img class='foto' src='../$foto_cpf' alt='FOTO DO CPF'></a><br>";
          }
        ?>
        <span>Fodo do CPF: </span><input type="file" <?php if($id == 0){echo 'required';} ?> name="foto_cpf"><br><br>
        <?php
          if($foto_rg != ""){
            echo "<a href='../$foto_rg' download><img class='foto' src='../$foto_rg' alt='FOTO DO RG'></a><br>";
          }
        ?>
        <span>Fodo do RG: </span><input type="file" <?php if($id == 0){echo 'required';} ?> name="foto_rg"><br><br>
        <input type="submit" value="Cadastrar">
      </form>
    </div>
  </body>
</html>
