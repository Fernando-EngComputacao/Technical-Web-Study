<?php
  session_start();
  if(isset($_SESSION['sujif'])){
    if($_SESSION['sujif']['tipo'] != 0){
      session_unset($_SESSION['sujif']);
      session_destroy();
      header("Location: ../login.php");
    }
  }
  else{
    session_destroy();
    header("Location: ../login.php");
  }
?>
