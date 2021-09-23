<?php

function enviar_email($para, $assunto, $mensagem) {

    ini_set('display_errors', 1);

    error_reporting(E_ALL);

    // $headers = "De: SUJIF - Sistema Unificado para os Jogos dos Institutos Federais";
    $headers = "De: dayllon.jogos@gmail.com";

    if(mail($para, $assunto, $mensagem, $headers)){
        return "Ok";
    } else {
        return "Falha";
    }
}
// EXEMPLO:

// $html = '<!DOCTYPE html>
// <html lang="en" dir="ltr">
// <body>
// <marquee>hhehee</marquee>
// <b>ola</b>
// </body>
// </html>';
//
// echo enviar_email("zazof@daabox.com", "Cadastro", $html);
?>
