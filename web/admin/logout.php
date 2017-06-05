<?php
    session_start();
    session_destroy();
    header("Location: ../collection_view.php");
    die();
?>
