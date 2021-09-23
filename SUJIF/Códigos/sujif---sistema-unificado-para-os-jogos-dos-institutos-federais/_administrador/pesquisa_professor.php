<?php
  include 'session.php';

  if(isset($_POST['pesq'])){
    include '../conexao.php';
    $pesq = $_POST['pesq'];
    $campus_id = $_POST['campus_id'];
    $pesq = "$pesq%";

    if ($campus_id == -1){
      //caso a pesquisa seja apenas por nome;
      $sql = "select professor.id,professor.nome,professor.status,campus.nome from campus, professor, competicao where campus.id = professor.campus_id and professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) and professor.nome like ? order by professor.status desc;";
      $stmt = mysqli_prepare($conexao,$sql);
      mysqli_stmt_bind_param($stmt,'s',$pesq);
    }
    else{
      //caso tambem tenha campus na pesquisa
      $sql = "select professor.id,professor.nome,professor.status,campus.nome from campus, professor, competicao where campus.id = professor.campus_id and professor.competicao_id = competicao.id and competicao.id = (select max(id) from competicao) and professor.nome like ? and campus.id = ? order by professor.status desc;";
      $stmt = mysqli_prepare($conexao,$sql);
      mysqli_stmt_bind_param($stmt,'si',$pesq,$campus_id);
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$id,$nome,$status,$campus);
    $array = [[],[],[]];

    while (mysqli_stmt_fetch($stmt)) {
      if($status == 2){
        $i = 2;
      }
      else if($status == 1) {
        $i = 1;
      }
      else if($status == 0){
        $i = 0;
      }
      $array[$i][] = [$id,$nome,$campus];
    }
    mysqli_stmt_close($stmt);
    // echo sizeof($array[2]) . " - " . sizeof($array[1]) . " - " . sizeof($array[0]);


    echo "<h3 class='avaliar'>Professores Pendentes:</h3><div class='tipo_professor'>";
    echo "<ul class='lista_professor'>";
    if(sizeof($array[2]) == 0){
      echo "<li><div class='professor'>Nenhum professor cadastrado</div></li>";
    }
    else{
      for ($i=0; $i < sizeof($array[2]); $i++) {
        $id = $array[2][$i][0];
        $nome = $array[2][$i][1];
        $campus = $array[2][$i][2];

        echo "<li><a href='avaliar_professor.php?i=$id'><div class='btn_avaliar' >AVALIAR</div><div class='professor'>$nome - $campus</div></a></li>";
      }
    }
    echo "</ul></div>";


    echo "<h3 class='aceito'>Professores aceitos:</h3><div class='tipo_professor'>";
    echo "<ul class='lista_professor'>";
    if(sizeof($array[1]) == 0){
      // echo "<div class='professor'></div><br>";
      echo "<li><div class='professor'>Nenhum professor cadastrado</div></li>";
    }
    else{
      for ($i=0; $i < sizeof($array[1]); $i++) {
        $id = $array[1][$i][0];
        $nome = $array[1][$i][1];
        $campus = $array[1][$i][2];

        echo "<li><a href='avaliar_professor.php?i=$id'><div class='btn_avaliar' >AVALIAR</div><div class='professor'>$nome - $campus</div></a></li>";
      }
    }
    echo "</ul></div>";


    echo "<h3 class='negado'>Professores negados:</h3><div class='tipo_professor'>";
    echo "<ul class='lista_professor'>";
    if(sizeof($array[0]) == 0){
      echo "<li><div class='professor'>Nenhum professor cadastrado</div><li>";
    }
    else{
      for ($i=0; $i < sizeof($array[0]); $i++) {
        $id = $array[0][$i][0];
        $nome = $array[0][$i][1];
        $campus = $array[0][$i][2];

        echo "<li><a href='avaliar_professor.php?i=$id'><div class='btn_avaliar' >AVALIAR</div><div class='professor'>$nome - $campus</div></a></li>";
      }
    }
    echo "</ul></div>";

}
/*
if($status == 2){
  echo "<a href='avaliar_professor.php?id=$id'><div class='professor'>$nome - $campus - AVALIAR</div></a><br>";
  $cont++;
}
else if($status == 1){
  if($cont == 0){
    echo "<div class='professor'>Nenhum professor cadastrado</div><br>";
  }
  $cont = -1;

  if($valor != $status){
    echo "</div><h3>Professores Aceitos</h3><div class='tipo_professor'>";
    $valor = $status;
  }

  echo "<a href='avaliar_professor.php?id=$id'><div class='professor'>$nome - $campus - V</div></a><br>";
  $cont++;
}
else if($status == 0){
  if($cont == -1){
    echo "<div class='professor'>Nenhum professor cadastrado</div><br>";
  }
  $cont = -2;

  if($valor != $status){
    echo "</div><h3>Professores Negados</h3><div class='tipo_professor'>";
    $valor = $status;
  }

  echo "<a href='avaliar_professor.php?id=$id'><div class='professor'>$nome - X</div></a><br>";
  $cont++;
}
}
if($cont == -2){
echo "<div class='professor'>Nenhum professor cadastrado</div><br>";
}
*/
?>
