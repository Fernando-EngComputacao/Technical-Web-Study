<!DOCTYPE html>
<?php
  include 'session.php';

  function master($codigo) {
      if($_SESSION['sujif']['master'] == 0){
          echo $codigo;
      }
  }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Seja bem vindo ao SUJIF</title>
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
        <?php include "../cabecalho.php"; ?>

        <div class="content col-9">
            <p>Seja bem vindo ao SUJIF!! Clique no simbolo "<img class="ex" src="../_imagens/menu.png">" no canto superior esquerdo ou em uma opção abaixo para começar:</p><br>

            <div class="funcoes">
                <?php
                    master('
                        <div class="funcao">
                            <img src="../_imagens/icon_gerenciar.png" alt=""><span><a href="#">Gerenciar Competição</a></span>
                        </div>
                    ');

                    master('
                        <div class="funcao">
                            <img src="../_imagens/icon_gerenciar.png" alt=""><span><a href="gerenciar_administradores.php">Gerenciar Administradores</a></span>
                        </div>
                    ')
                ?>

                <div class="funcao">
                    <img src="../_imagens/icon_gerenciar.png" alt=""><span><a href="avaliar_professores.php">Gerenciar Professores</a></span>
                </div>
                <div class="funcao">
                    <img src="../_imagens/icon_gerenciar.png" alt=""><span><a href="gerenciar_modalidades.php">Gerenciar Modalidades</a></span>
                </div>
                <div class="funcao">
                    <img src="../_imagens/icon_gerenciar.png" alt=""><span><a href="cadastrar_prova.php">Gerenciar Provas</a></span>
                </div>
            </div>

            <div class="funcoes">
                <div class="funcao">
                    <img src="../_imagens/icon_gerar.png" alt=""><span><a href="#">Gerar Relatórios</a></span>
                </div>

                <?php
                    master('
                        <div class="funcao">
                            <img src="../_imagens/icon_gerar.png" alt=""><span><a href="#">Gerar Planilhas</a></span>
                        </div>
                    ')
                ?>

                <div class="funcao">
                    <img src="../_imagens/icon_lupa.png" alt=""><span><a href="gerenciar_atletas.php">Pesquisar Atleta</a></span>
                </div>
                <div class="funcao">
                    <img src="../_imagens/icon_past.png" alt=""><span><a href="#">Competições Passadas</a></span>
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

<!--
<div class="pagina">
  <div class="nav">
    <?php
      if($_SESSION['sujif']['master'] == 0){
        echo "<a href='#'>Gerenciar Competição</a>";
        echo "<a href='#'>Gerar Planilha</a>";
        echo "<a href='gerenciar_administradores.php'>Gerenciar Administradores</a>";
      }
    ?>
    <a href="#">Gerenciar Professores</a>
    <a href="#">Gerenciar Modalidades</a>
    <a href="#">Gerenciar Provas</a>
    <a href="#">Gerar Relatórios</a>
    <a href="#">Competições Passadas</a>
    <a href="#">Minha Conta</a>
    <a href="../sair.php">Sair</a>
  </div>
</div> -->




<!-- <!DOCTYPE html>
<?php
  include 'session.php';
?>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SUJIF - Sistema Unificado para os Jogos dos Institutos Federais</title>
  </head>
  <body>
    <div class="pagina">
      <div class="nav">
        <?php
          if($_SESSION['sujif']['master'] == 0){
            echo "<a href='#'>Gerenciar Competição</a>";
            echo "<a href='#'>Gerar Planilha</a>";
            echo "<a href='gerenciar_administradores.php'>Gerenciar Administradores</a>";
          }
        ?>
        <a href="avaliar_professores.php">Gerenciar Professores</a>
        <a href="gerenciar_modalidades.php">Gerenciar Modalidades</a>
        <a href="cadastrar_prova.php">Cadastrar Provas</a>
        <a href="gerenciar_atletas.php">Pesquisar Alunos</a>
        <a href="#">Gerar Relatórios</a>
        <a href="#">Competições Passadas</a>
        <a href="conta.php">Minha Conta</a>
        <a href="../sair.php">Sair</a>
      </div>
    </div>
  </body>
</html> -->
