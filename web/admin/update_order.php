<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }


    //include database class
    include_once '../dbconn.php';

    $order = $_POST['order'];

    $update_order = "UPDATE web_res SET img_order = :pos
                            WHERE file_name = :file AND album_id = :a_id;";

    $count = 0;
    foreach ($order as $item) {
        $path = explode('/', $item);
        $file = $path[3];
        $statement = $dbconn->prepare($update_order);
        $statement->bindValue(":pos", $count, PDO::PARAM_STR);
        $statement->bindValue(":file", $file, PDO::PARAM_STR);
        $statement->bindValue(":a_id", $_SESSION['album_id'], PDO::PARAM_STR);
        $statement->execute();
        $count++;
    }
?>
