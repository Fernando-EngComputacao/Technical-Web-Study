<?php
  include 'session.php';
  if($_SESSION['sujif']['tipo'] == 0){
    header("Location: menu.php");
  }
?>
