<?php
  include 'session.php';
  include 'enviar_email.php';


  $msg = 0;
  if(!isset($_POST['id'])){
    header("Location: menu.php");
  }
  include '../conexao.php';
  $id = $_POST['id'];
  $tipo = $_POST['tipo'];

  $sql_mail = "select email, nome from professor where id = ?";
  $stmt_mail = mysqli_prepare($conexao, $sql_mail);
  mysqli_stmt_bind_param($stmt_mail,'i',$id);
  mysqli_stmt_execute($stmt_mail);
  mysqli_stmt_bind_result($stmt_mail, $email, $nome);
  mysqli_stmt_fetch($stmt_mail);
  mysqli_stmt_close($stmt_mail);

  $mensagem1 = '
      <!DOCTYPE html>
      <html lang="en" dir="ltr">
      <head>
      <meta charset="utf-8">
      <title>Email</title>
      <style media="screen">
      body {
          font-size: 20px;
          font-family: Arial, sans-serif;
          text-align: center;
      }

      a {
          text-decoration: none;
          font-weight: bold;
      }

      .header {
          width: 100%;
          text-align: center;
      }

      .header img {
          width: 10%;
      }

      .mensagem {
          background-color: lightgrey;
          padding: 10px;
      }

      .mensagem a {
          color: #127547;
          background-color: white;
          border-radius: 20px;
          padding: 20px;
          border: solid thin lightgrey;
      }

      .rodape {
          background-color: black;
          padding: 20px;
          color: lightgrey;
      }
      </style>
      </head>
      <body>
      <div class="header">
      <img src="_imagens/logo_verde.png">

      </div>

      <br>

      <div class="mensagem">
          <p><b>Saudações ' . $nome . ',</b></p>
              <p>Sua inscrição ao SUJIF(Sistema Unificado dos Jogos dos Institutos Federais Goianos) foi <span style="color: green; font-weight: bold;">ACEITA</span>!</p>
              <p>Clique no botao abaixo para ser redirecionado para a página de login do SUJIF</p>
              <br><a href="#">Clique Aqui!</a><br><br><br>
          </div>


          <div class="rodape">
              Atenciosamente Equipe do SUJIF.
          </div>
      </body>
      </html>

  ';

  $mensagem2 = '
      <!DOCTYPE html>
      <html lang="en" dir="ltr">
      <head>
      <meta charset="utf-8">
      <title>Email</title>
      <style media="screen">
      body {
          font-size: 20px;
          font-family: Arial, sans-serif;
          text-align: center;
      }

      a {
          text-decoration: none;
          font-weight: bold;
      }

      .header {
          width: 100%;
          text-align: center;
      }

      .header img {
          width: 10%;
      }

      .mensagem {
          background-color: lightgrey;
          padding: 10px;
      }

      .mensagem a {
          color: #127547;
          background-color: white;
          border-radius: 20px;
          padding: 20px;
          border: solid thin lightgrey;
      }

      .rodape {
          background-color: black;
          padding: 20px;
          color: lightgrey;
      }
      </style>
      </head>
      <body>
      <div class="header">
      <img src="_imagens/logo_verde.png">

      </div>

      <br>

      <div class="mensagem">
          <p><b>Saudações ' . $nome . ',</b></p>
              <p>Sua inscrição ao SUJIF(Sistema Unificado dos Jogos dos Institutos Federais Goianos) foi <span style="color: red;  font-weight: bold;">NEGADA</span>!</p>
              <p>Você não terá acesso à plataforma do SUJIF ao menos que um administrador lhe revalide, sentimos muito.</p>
          </div>


          <div class="rodape">
              Atenciosamente Equipe do SUJIF.
          </div>
      </body>
      </html>

  ';

  if(isset($_POST['status'])){
    $status = $_POST['status'];
      if($tipo == "Negar"){
        $alt = 0;
        $msg = $mensagem2;
      }
      else if($tipo == "Aprovar"){
        $alt = 1;
        $msg = $mensagem1;
      }
      $sql = "update professor set status = ? where id = ?;";
      $stmt = mysqli_prepare($conexao,$sql);
      mysqli_stmt_bind_param($stmt,'ii',$alt,$id);
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);

        if ($alt == 1) {
            enviar_email($email, "Status SUJIF", $msg);
        }


        header("Location: avaliar_professores.php");
      }
      else{
        $msg = 1;
        //erro na alteracao
      }
    }
?>
