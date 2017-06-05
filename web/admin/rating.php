<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }
?>
