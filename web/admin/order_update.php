<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }
    //include database class
    include_once 'dbconn.php';
    $db = new DB();

    //get images id and generate ids array
    $idArray = explode(",",$_POST['ids']);

    //update images order
    $db->updateOrder($idArray);
?>
