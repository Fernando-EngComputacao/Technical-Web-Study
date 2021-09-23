<?php
  function upload($tmp, $name, $altura1, $largura1, $pasta) {
    if($name != ''){
      $extensao = "." . pathinfo($name,PATHINFO_EXTENSION);
      if($extensao != '.png' && $extensao != '.jpg' && $extensao != '.jpeg' && $extensao != '.gif'){
        return(-1);
      }
      else{
        if($extensao == '.png'){
          $img = imagecreatefrompng($tmp);
        }
        else if($extensao == '.jpg' || $extensao == '.jpeg'){
          $img = imagecreatefromjpeg($tmp);
        }
        else if($extensao == ".gif"){
          $img = imagecreatefromgif($tmp);
        }

        $nome = time() . sha1(uniqid());

        $x = imagesx($img);
        $y = imagesy($img);
        //
        // $largura = ($x > $largura) ? $largura : $x;
        // $altura = ($largura*$y) / $x;
        //
        // if ($altura > $largura) {
        //   $altura = $largura;
        //   $largura = ($altura * $x) / $y;
        // }
        $largura = $largura1;
        $altura = $altura1;
        $nova = imagecreatetruecolor($largura, $altura);
        imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);
        $novo_nome = $pasta. "/" . $nome . $extensao;
        imagejpeg($nova, $novo_nome);
        // imagedestroy($img);
        // imagedestroy($nova);
        return(substr($novo_nome,3));
      }
    }
    else{
      return(-2);
    }

    //   upload($_FILES['img']['tmp_name'], $_FILES['img']['name'] . ".jpg", 400, '../foto_perfil');
  }
?>
