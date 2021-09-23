<!DOCTYPE html>
<?php
  include 'session.php';

  function master($codigo) {
      if($_SESSION['sujif']['master'] == 0){
          echo $codigo;
      }
  }
?>
<html lang="pt" dir="ltr">
  <head>
    <title>SUJIF - Sistema Unificado para os Jogos dos Institutos Federais</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../_css/master.css">
    <script src="../_js/jquery_3-3-1.js"></script>
    <script type="text/javascript" src="../_js/sidenav.js"></script>
    <script type="text/javascript">
    var sw_jif = true;

    $(document).ready(function(){
        $(".btn_menu").click(function(){
            if (sw_jif) {
                $(".jif_men").hide("slow");
                sw_jif = false;
            } else {
                $(".jif_men").show("slow");
                sw_jif = true;
            }

        });
    });
    </script>
  </head>
  <body>

      <?php include "../cabecalho_professor.php"; ?>

    <div class="content col-9">
        <p>Seja bem vindo ao SUJIF!! Clique no simbolo "<img class="ex" src="../_imagens/menu.png">" no canto superior esquerdo ou em uma opção abaixo para começar:</p><br>

        <div class="funcoes">


            <div class="funcao">
                <img src="../_imagens/adicionar.png" alt=""><span><a href="cadastrar_atleta.php">Cadastrar Atleta</a></span>
            </div>
            <div class="funcao">
                <img src="../_imagens/icon_gerenciar.png" alt=""><span><a href="gerenciar_atletas.php">Gerenciar Atletas</a></span>
            </div>
            <div class="funcao">
                <img src="../_imagens/icon_gerar.png" alt=""><span><a href="#.php">Gerar Relatórios</a></span>
            </div>
            <div class="funcao">
                <img src="../_imagens/icon_gerar.png" alt=""><span><a href="#.php">Gerar Crachás</a></span>
            </div>
        </div>


        <div class="funcoes">
            <div class="funcao">
                <img src="../_imagens/icon_visualizar.png" alt=""><span><a href="Visualizar_modalidades.php">Visualizar Modalidades</a></span>
            </div>
            <div class="funcao">
                <img src="../_imagens/icon_user.png" alt=""><span><a href="conta.php">Minha Conta</a></span>
            </div>
        </div>

        <div class="funcoes">
            <img src="../_imagens/jif.png" class="jif_men">
        </div>
    </div>
  </body>
</html>
