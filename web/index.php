<?php session_start(); ?>
<?php
  $_SESSION["duc"] = "duc";
  $_SESSION["bmw"] = "bmw";
  $_SESSION["cbr"] = "cbr";
  $_SESSION["gxr"] = "gxr";
  header('Location: store.php');
  exit();
?>
