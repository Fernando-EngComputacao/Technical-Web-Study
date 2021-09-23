<?php
  session_start();
  session_unset($_SESSION['sujif']);
  session_destroy();
  header("Location: login.php");
?>
