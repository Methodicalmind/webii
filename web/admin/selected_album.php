<?php
        session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }
    include "../dbconn.php";

    $album_id = $_POST['a_id'];
//    echo "album: ".$album_id;

    $query_a_name = "SELECT name FROM album WHERE id = :a_id;";
    $statement = $dbconn->prepare($query_a_name);
    $statement->bindValue(":a_id", $album_id, PDO::PARAM_STR);
    $statement->execute();

    $album_name = $statement->fetch(PDO::FETCH_ASSOC);
    $a_name = $album_name['name'];

    $query_imgs = "SELECT id, file_name FROM web_res
                            WHERE album_id = :a_id
                            ORDER BY img_order;";

    $statement = $dbconn->prepare($query_imgs);
    $statement->bindValue(":a_id", $album_id, PDO::PARAM_STR);
    $statement->execute();

    $results = $statement->fetchALL(PDO::FETCH_ASSOC);
    echo '<div class="grid-client">';
    foreach($results as $img) {
        echo '<div class="grid-item-client">
            <img src="web_res_img/'.$_SESSION['collection'].'/'.$a_name.'/'
            .$img["file_name"].'">
            </div>';
    }
    echo '</div><script src="../js/client-packery.js"></script>';
?>
