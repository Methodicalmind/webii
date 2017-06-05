<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }
    include "../dbconn.php";

    $files = $_REQUEST['img_delete'];
    $delete_wr = "DELETE FROM web_res WHERE file_name = :img AND album_id = :a_id;";
    $delete_hr = "DELETE FROM high_res WHERE file_name = :img AND album_id = :a_id;";

    foreach($files as $path) {
        $parse = explode('/', $path);
        $collection = $parse[1];
        $album = $parse[2];
        $img = $parse[3];

        //delete from web_res
        $statement = $dbconn->prepare($delete_wr);
        $statement->bindValue(":img", $img, PDO::PARAM_STR);
        $statement->bindValue(":a_id", $_SESSION['album_id'], PDO::PARAM_STR);
        $statement->execute();

        //delete from high_res
        $statement = $dbconn->prepare($delete_hr);
        $statement->bindValue(":img", $img, PDO::PARAM_STR);
        $statement->bindValue(":a_id", $_SESSION['album_id'], PDO::PARAM_STR);
        $statement->execute();

        //delete from high_res
        unlink('high_res_img/'.$collection.'/'.$album.'/'.$img);
        //delete from web_res
        unlink($path);
    }
    echo "Files were removed.";
?>
