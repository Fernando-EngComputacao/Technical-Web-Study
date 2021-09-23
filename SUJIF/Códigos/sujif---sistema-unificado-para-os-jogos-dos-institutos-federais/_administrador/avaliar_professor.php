<!DOCTYPE html>
<?php
  include 'session.php';

    function master($codigo) {
        if($_SESSION['sujif']['master'] == 0){
            echo $codigo;
        }
    }

    if(!isset($_GET['i'])){
      header("Location: menu.php");
    }
    $i = $_GET['i'];
    include '../conexao.php';
    $sql = "select professor.id, professor.nome, professor.status, professor.cpf, professor.rg, professor.telefone, professor.email, professor.num_suap, campus.nome as campus_nome, campus.sigla, campus.uf from professor, campus where campus.id = professor.campus_id and professor.id = ?;";
    $stmt = mysqli_prepare($conexao,$sql);
    mysqli_stmt_bind_param($stmt,'i',$i);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$id,$nome,$status,$cpf,$rg,$telefone,$email,$num_suap,$campus_nome,$campus_sigla,$campus_uf);
    mysqli_stmt_store_result($stmt);
    if(mysqli_stmt_num_rows($stmt) != 1){
      mysqli_stmt_close($stmt);
      header("Location: menu.php");
    }
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
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
    </head>

    <body>
        <?php include "../cabecalho.php"; ?>

        <div class="content col-9 avl_professor">
            <div class="informacoes_professor">
                <h1>Avaliar Professor</h1>

                <ul>
                    <li><span>Nome: <?php echo $nome ?></span></li>
                    <li><span>CPF: <?php echo $cpf ?></span></li>
                    <li><span>RG: <?php echo $rg ?></span></li>
                    <li><span>E-mail: <?php echo $email ?></span></li>
                    <li><span>Telefone: <?php echo $telefone ?></span></li>
                    <li><span>Número Suap: <?php echo $num_suap ?></span></li>
                    <li><span>Campus: <?php echo "$campus_nome - $campus_sigla ($campus_uf)" ?></span></li>
                </ul>
            </div>

            <br>

            <div class="acng">
                <form class="informacoes_professor" action="alterar_status_professor.php" method="post">
                    <input type="hidden" name="status" value="<?php echo $status ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <?php
                    if ($status == 1 || $status == 2){
                        echo '<input class="negar" type="submit" name="tipo" value="Negar"> ';
                    }
                    if($status == 0 || $status == 2){
                        echo '<input class="aprovar" type="submit" name="tipo" value="Aprovar">';
                    }
                    ?>


                </form>
            </div>
        </div>
    </body>
</html>
