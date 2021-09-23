<?php
  if(!isset($_SESSION['sujif'])){
    include 'session.php';
  }
  if ($_SESSION['sujif']['master'] == 1){
    header("Location: menu.php");
  }
?>
