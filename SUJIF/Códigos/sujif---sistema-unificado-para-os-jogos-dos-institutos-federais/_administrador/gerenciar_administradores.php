<!DOCTYPE html>
<?php
  include 'session_master.php';

  function master($codigo) {
      if($_SESSION['sujif']['master'] == 0){
          echo $codigo;
      }
  }
?>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SUJIF - Sistema Unificado para os Jogos dos Institutos Federais</title>
    <link rel="stylesheet" href="../_css/master.css">
    <script src="../_js/jquery_3-3-1.js"></script>
    <script src="../_js/sidenav.js"></script>
    <script src="../_js/pesquisa_administrador.js"></script>
  </head>
  <body>
      <?php include "../cabecalho.php"; ?>

    <div class="content col-9">
        <h2>Gerenciar Administradores</h2><hr><br>

      <img src="../_imagens/adicionar.png" alt="ADICIONAR" width="50px"> <a href="cadastrar_administrador.php" class="cad_adm">Cadastrar um novo administrador</a><br>

      <div class="pesquisa">
        <br>
        <input type="text" id="pesq" maxlength="60" placeholder="Insira um nome a ser pesquisado...."> <button type="button" id="button" onclick="pesquisar_administrador()">Pesquisar</button>
        <br><br>

        <div id="resposta">
          <table>
            <!-- <tr>
              <td class="titulo" colspan="6">Adminstradores cadastrados nessa competicao</td>
            </tr> -->
            <tr class="titulo">
              <td>Nome</td>
              <td>CPF</td>
              <td>E-mail</td>
              <td>Competição</td>
              <td>Alterar</td>
              <td>Deletetar</td>
            </tr>

          </table>
          <script type="text/javascript">
            pesquisar_administrador();
          </script>
        </div>
      </div>
    </div>
  </body>
</html>
