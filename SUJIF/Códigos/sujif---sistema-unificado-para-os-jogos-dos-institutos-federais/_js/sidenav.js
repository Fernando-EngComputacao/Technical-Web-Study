var aberto = false;

function act_menu() {
    if (aberto == false) {
        $(".sidenav").css("display", "inherit");
        $(".sidenav").css("width", "23%");
        $(".content").css("width", "77%");
        aberto = true;
        // getElementById('sidenav').style.width = "250px";
    } else {
        $(".sidenav").css("width", "0%");
        $(".content").css("width", "100%");
        // recolher('el_gerenciar', 'gerenciar');
        // recolher('el_gerar', 'gerar');
        setTimeout("sumir()", 300)
        aberto = false;
    }
}

function sumir() {
    $(".sidenav").css("display", "none");

}
//
function expandir(father, elemento) {
    document.getElementById(elemento + "_icon").src = "../_imagens/chevron-down.png";
    // $("#" + elemento).css("transition", "0.5s");
    $("#" + elemento).css("height", "auto");
    $("#" + father).attr("onclick", "recolher('" + father + "', '"+ elemento + "')");
}

function recolher(father, elemento) {
    document.getElementById(elemento + "_icon").src = "../_imagens/chevron-right.png";
    // $("#" + elemento).css("transition", "0.5s");
    $("#" + elemento).css("height", "-10px");
    $("#" + father).attr("onclick", "expandir('" + father + "', '"+ elemento + "')");
}
