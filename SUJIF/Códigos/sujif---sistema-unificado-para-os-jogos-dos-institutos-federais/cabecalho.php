<?php

// include "/_administrador/session.php";
//
// function master($codigo) {
//     if($_SESSION['sujif']['master'] == 0){
//         echo $codigo;
//     }
// }


echo '<div class="header col-12">';
echo '    <div class="col-2 center" ><a href="#" id="btn_menu" onclick="act_menu()"><img src="../_imagens/menu.png" class="btn_menu" alt="Não foi possivel carregar a imagem"></a></div>';
echo '    <div class="col-8 center" ><a href="./"><img src="../_imagens/logo.png" class="logo" alt="Não foi possivel carregar a imagem"></a></div>';
echo '    <div class="col-2 center" ><a href="../sair.php"><button type="button" class="sair" name="sair">Sair</button></a></div>';
echo '</div>';
echo '';
echo '<div class="sidenav col-3">';
echo '    <ul>';
echo '        <li><img class="ico_exp" src="../_imagens/chevron-right.png" id="gerenciar_icon"><a href="#" id="el_gerenciar" onclick="expandir(' . "'el_gerenciar', 'gerenciar'" . ')">GERENCIAR</a></li>';
echo '        <ul class="child" id="gerenciar">';
master("<li><a href='#'>GERENCIAR COMPETIÇÕES</a></li>");
master("<li><a href='gerenciar_administradores.php'>GERENCIAR ADMINISTRADORES</a></li>");
echo '            <li><a href="avaliar_professores.php">GERENCIAR PROFESSORES</a></li>';
echo '            <li><a href="gerenciar_modalidades.php">GERENCIAR MODALIDADES</a></li>';
echo '            <li><a href="cadastrar_prova.php">GERENCIAR PROVAS</a></li>';
echo '        </ul>';
echo '';
echo '        <li><img class="ico_exp" src="../_imagens/chevron-right.png" id="gerar_icon"><a href="#" id="el_gerar" onclick="expandir(' . "'el_gerar', 'gerar'" . ')">GERAR</a></li>';
echo '        <ul class="child" id="gerar">';
echo '            <li><a href="#">GERAR RELATÓRIOS</a></li>';
master('<li><a href="_gerar_planilha/gerar_planilha.php">GERAR PLANILHA</a></li>');
echo '        </ul>';
echo '';
echo '        <li><a href="gerenciar_atletas.php">PESQUISAR ATLETA</a></li>';
echo '        <li><a href="#">COMPETIÇÕES PASSADAS</a></li>';
echo '        <li><a href="conta.php">MINHA CONTA</a></li>';
echo '    </ul>';
echo '</div>';
?>
