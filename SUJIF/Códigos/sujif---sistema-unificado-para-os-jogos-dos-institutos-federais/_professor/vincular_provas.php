<!DOCTYPE html>
<?php
  include 'session.php';
  include '../conexao.php';
  if(isset($_GET['i'])){
    $id = $_GET['i'];
    $sql = "select competidor.prova_id from competidor, atleta, professor, competicao where professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) and atleta.professor_id = professor.id and atleta.id = competidor.atleta_id and atleta.id = ?;";
    $stmt = mysqli_prepare($conexao,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id);
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt,$prova_id);
        $ids_provas_atleta = [];
        while (mysqli_stmt_fetch($stmt)) {
          $ids_provas_atleta[] = $prova_id;
        }
    }
    else{
      header("Location: menu.php");
    }
  }
  else{
    header("Location: menu.php");
  }
  if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
  }
  else{
    $msg = 0;
  }
?>
<html lang="pt" dir="ltr">
  <head>
    <title>SUJIF - Sistema Unificado para os Jogos dos Institutos Federais</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <script type="text/javascript" src="../_js/jquery_3-3-1.js" charset="utf-8"></script>
    <script type="text/javascript" src="../_js/gerenciar_modalidades.js"></script>
    <link rel="stylesheet" type="text/css" href="../_css/master.css">
    <script type="text/javascript" src="../_js/sidenav.js"></script>

    <style media="screen">
      .modalidade{
        background-color: white;
        padding: 20px;
        font-size: 18px;
        margin: 10px;
      }
      .prova{
        margin-top: 10px;
        border: 1px solid green;
        display: none;
        padding: 10px;
      }
      .descricao_prova, .descricao_modalidade, .cadastro_prova{
        color: black;
        display: none;
        margin-top: 10px;

      }
      .icon{
        height: 30px;
        width: 30px;
      }
    </style>
  </head>
  <body>
      <?php include "../cabecalho_professor.php"; ?>

    <div class="content col-9">
      <h3>Vincular Atletas à provas</h3>
      <p>Selecione as prova a qual deseja víncular.</p>
      <?php
        if($msg != 0){
          echo "<div class='msg'>";
          if($msg == 1){
            echo "limite de modalidade para o atleta exedidos!";
          }
          echo "</div>";
        }
      ?>
      <div class="listagem">
        <form class="formulario" action="resp_vincular_provas.php" method="post">
          <input type="hidden" name="i" value="<?php echo $id; ?>">
          <?php
          $sql = "select modalidade.id as modalidade_id, modalidade.nome as modalidade, modalidade.descricao as desc_modalidade, prova.id as prova_id, prova.nome as prova, prova.tipo, prova.descricao as desc_prova from  modalidade, prova, competicao where prova.modalidade_id = modalidade.id and modalidade.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) order by modalidade.id asc;";
          $stmt = mysqli_prepare($conexao,$sql);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$modalidade_id, $modalidade, $desc_modalidade, $prova_id, $prova, $prova_tipo, $desc_prova);
          mysqli_stmt_store_result($stmt);
          $atual = $modalidade_id;
          $inicio = 1;
          $cont = 0;
          if(mysqli_stmt_num_rows($stmt) > 0){
            while(mysqli_stmt_fetch($stmt)){
              if(in_array($prova_id,$ids_provas_atleta)){
                $checked = "checked";
              }
              else{
                $checked = "";
              }
              if($modalidade_id == $atual){
                echo "<div class='prova'><input type='checkbox' name='provas[]' value='$prova_id' $checked>$prova - ";
                if($prova_tipo == 0){
                  echo "Individual";
                }
                else if($prova_tipo == 1){
                  echo "Coletiva";
                }
                echo "<img class='icon setinha_baixo_desc' src='../_imagens/setinha_baixo.png'><div class='descricao_prova'>$desc_prova</div></div>";
              }
              else{
                echo "</div></div>";
                $atual = $modalidade_id;
                echo "<div class='modalidade'><img class='icon setinha_baixo' src='../_imagens/setinha_baixo.png'> $modalidade";
                echo "<div class='descricao_modalidade'>$desc_modalidade</div>";

                echo "<div class='prova'><input type='checkbox' name='provas[]' value='$prova_id' $checked>$prova - ";
                if($prova_tipo == 0){
                  echo "Individual";
                }
                else if($prova_tipo == 1){
                  echo "Coletiva";
                }
                echo "<img class='icon setinha_baixo_desc' src='../_imagens/setinha_baixo.png'><div class='descricao_prova'>$desc_prova</div></div>";
              }
            }
            echo "</div>";
          }
          else{
            echo "<div class='modalidade'>Nenhuma modalidade cadastrada</div>";
          }
          mysqli_stmt_close($stmt);
          ?>
          <input type="submit"  value="Víncular">
        </form>
      </div>
    </div>
  </body>
</html>
