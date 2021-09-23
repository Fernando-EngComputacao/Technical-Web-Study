<!DOCTYPE html>
<?php
  $id = 0;
  $nome_prof = "";
  $cpf = "";
  $rg = "";
  $email = "";
  $telefone = "";
  $num_suap = "";
  include 'conexao.php';
  if (isset($_GET['i'])) {
    if($_GET['i'] == 'alt'){
      include '_professor/session.php';
      $id = $_SESSION['sujif']['id'];
      $sql = "select professor.nome, professor.cpf, professor.rg, professor.email, professor.telefone, professor.num_suap from professor, competicao where competicao.id = professor.competicao_id and competicao.id = (select max(id) from competicao) and professor.id = ?;";
      $stmt = mysqli_prepare($conexao,$sql);
      mysqli_stmt_bind_param($stmt,'i',$_SESSION['sujif']['id']);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt,$nome_prof,$cpf,$rg,$email,$telefone,$num_suap);
      mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt) != 1){
        header("Location: _professor/menu.php");
      }
      mysqli_stmt_fetch($stmt);
      mysqli_stmt_close($stmt);
    }
    else{
      $id = -3;
    }
  }
?>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SUJIF - Sistema Unificado para os Jogos dos Institutos Federais</title>
    <script type="text/javascript" src="_js/input_cpf.js"></script>
    <script src="_js/cadastrar_campus.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="_css/master.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="_js/sidenav.js"></script>
    <!-- <script type="text/javascript" src="_js/jquery_3-3-1.js"></script> -->
    <script type="text/javascript" src="_js/strong_pass.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#senha").keyup(function() {
          passwordStrength(jQuery(this).val());
        });
    });
    </script>

    <style media="screen">
      #new_campus{
        display: none;
      }
    </style>
  </head>
  <body>
      <div class="header col-12" style="text-align: center;">
          <div class="center" ><img src="_imagens/logo.png" class="logo" alt="Não foi possivel carregar a imagem"></div>
      </div>


    <div class="content col-9">
      <div class="informacoes">
        <?php
          //Exibir dados da competicao
          // include 'conexao.php';
          if($id == 0){
              echo "<h3>Competição em Andamento:</h3>";

            $sql = "select id, nome, campus, data_abertura, data_encerramento, descricao from competicao where id = (select max(id) from competicao);";
            $stmt = mysqli_prepare($conexao,$sql);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt,$id_comp,$nome,$campus,$abertura,$encerramento,$descricao);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            echo "<table border='1'><tr><td colspan='5'>$nome</td></tr><tr><td>Local:</td><td colspan='4'>Campus $campus</td></tr><tr><td>Data:</td><td colspan='4'>$abertura à $encerramento</td></tr><tr><td colspan='5'>$descricao</td></tr></table>";

            echo '<br><h3>Você que é professor quer participar com seu campus? Faça seu cadastro abaixo!</h3>';
          }
        ?>
      </div>
      <?php
        if(isset($_GET['msg'])){
          $msg = $_GET['msg'];
          echo "<div id='msg'>";
          if($msg == 0){
            echo "Cadastro realizado com sucesso!";
          }
          else if($msg == 1){
            echo "Selecione um campus para que seja possivel efetuar o cadastro.";
          }
          else if($msg == 2){
            echo "Erro no cadastro.";
          }
          else if($msg == 3){
            echo "Senhas desiguais ou menores que 8 caracteres.";
          }
          else if($msg == 4){
            echo "Dados inválidos.";
          }
          echo "</div>";
        }
      ?>
      <form class="formulario" action="resp_cadastro_professor.php" method="post"><br>
        <input type="hidden" name="i" value="<?php echo $id; ?>">
        <span>Nome:</span> <input type="text" name="nome" placeholder="Insira seu nome..." maxlength="60" required value="<?php echo $nome_prof; ?>"><br><br>
        <span>CPF:</span> <input type="text" name="cpf" placeholder="Insira seu cpf..." maxlength="14" required value="<?php echo $cpf; ?>" onkeydown="javascript: fMasc( this, mCPF );"><br><br>
        <span>RG:</span> <input type="text" name="rg" placeholder="Insira seu rg..." maxlength="7" required value="<?php echo $rg; ?>"><br><br>
        <span>Telefone:</span> <input type="text" name="telefone" placeholder="Insira seu telefone..." maxlength="14" required value="<?php echo $telefone; ?>" onkeydown="javascript: fMasc( this, mTel );"><br><br>
        <span>E-mail:</span> <input type="text" name="email" placeholder="Insira seu e-mail..." maxlength="80" required value="<?php echo $email; ?>"><br><br>
        <span>Senha:</span> <input type="password" id="senha" name="senha1" placeholder="Insira sua senha..." maxlength="60" required><br><br>
        <span class="forca">Força da Senha:</span> <div class="progress progress-striped active">
          <div id="jak_pstrength" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
      </div> <br><br>

        <span>Confirmar Senha:</span> <input type="password" name="senha2" placeholder="Confirme sua senha..." maxlength="60" required><br><br>
        <span>Número do Suap:</span> <input type="text" name="num_suap" placeholder="Insira seu número do Suap..." maxlength="20" value="<?php echo $num_suap; ?>" required><br><br>

        <?php
          if($id == 0){
            echo '
              <span>Campus:</span><br>
              <select name="campus" required onchange="cadastrar_campus(this.value)">
              <option value="-1">Selecione um campus...</option>
            ';
              $sql = "select campus.id, campus.nome, campus.sigla, campus.uf from campus, professor, competicao where campus.id = professor.campus_id and professor.competicao_id = competicao.id and competicao.id = ? group by campus.nome order by campus.nome asc;";
              $stmt = mysqli_prepare($conexao,$sql);
              mysqli_stmt_bind_param($stmt,'i',$id_comp);
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt,$id_campus,$nome_campus,$sigla,$uf);
              mysqli_stmt_store_result($stmt);
              if (mysqli_stmt_num_rows($stmt) > 0) {
                while(mysqli_stmt_fetch($stmt)){
                  echo "<option value='$id_campus'>$nome_campus - $sigla ($uf)</option>";
                }
              }
              echo '
                <option value="0">Não encontrei meu campus</option>
                </select><br>
                <div id="new_campus"><br>

                <span>Nome do seu Campus:</span><input type="text" name="nome_campus" placeholder="Insira o nome do seu campus" maxlength="80"><br><br>

                <span>Sigla do seu Campus:</span><input type="text" name="sigla_campus" placeholder="Insira a sigla do seu campus" maxlength="10"><br><br>

                <span>Estado do seu Campus:</span><br>

                <select id="estado" name="estado">
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
                <option value="ES">Estrangeiro</option>
                </select>
                </div><br><br>
              ';
          }
          else{
            echo "<input type='hidden' name='campus' value='-2'>";
          }
        ?>
        <input type="submit" value="Cadastrar-se">
      </form><br><br>
      <a href="login.php">Voltar ao Login...</a>
      <?php
        if($id != 0){
          echo "<a href='_professor/menu.php'>Voltar ou Menu</a>";
        }
      ?>
    </div>
  </body>
</html>
