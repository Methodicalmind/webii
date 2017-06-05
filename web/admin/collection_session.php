<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }

    $_SESSION['album'] = $_POST['album'];
    $_SESSION['collection'] = $_POST['collection'];
    $_SESSION['cover_photo'] = $_POST['cp'];
?>
