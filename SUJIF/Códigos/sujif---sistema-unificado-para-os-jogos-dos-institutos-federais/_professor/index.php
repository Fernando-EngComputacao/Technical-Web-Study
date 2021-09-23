<?php
  session_start();
  if($_SESSION['sujif']['tipo'] == 1){
    header("Location: menu.php");
  }
  else{
    session_destroy();
    header("Location: ../login.php");
  }
?>
