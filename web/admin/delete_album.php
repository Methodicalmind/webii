<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }
    include "../dbconn.php";

    $album_id = $_REQUEST['a_delete'];
    $query_album = "SELECT name FROM album WHERE id = :a_id;";

    $statement = $dbconn->prepare($query_album);
    $statement->bindValue(":a_id", $album_id, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $a_name = $result['name'];
//    echo $a_name;
    $wdir_img = [];
    $hdir_img = [];

    $srcDir = opendir('web_res_img/'.$_SESSION['collection'].'/'.$a_name);
    while($readFile = readdir($srcDir))
    {
        if($readFile != '.' && $readFile != '..')
        {
            array_push($wdir_img, $readFile);
        }
    }

    $srcDir = opendir('high_res_img/'.$_SESSION['collection'].'/'.$a_name);
    while($readFile = readdir($srcDir))
    {
        if($readFile != '.' && $readFile != '..')
        {
            array_push($hdir_img, $readFile);
        }
    }

    $delete_wr = "DELETE FROM web_res WHERE file_name = :img AND album_id = :a_id;";
    $delete_hr = "DELETE FROM high_res WHERE file_name = :img AND album_id = :a_id;";

    foreach($wdir_img as $img) {

        //delete from web_res
        $statement = $dbconn->prepare($delete_wr);
        $statement->bindValue(":img", $img, PDO::PARAM_STR);
        $statement->bindValue(":a_id", $album_id, PDO::PARAM_STR);
        $statement->execute();

        //delete from web_res
        unlink('web_res_img/'.$_SESSION['collection'].'/'.$a_name.'/'.$img);
    }

    foreach($hdir_img as $img) {
        //delete from high_res
        $statement = $dbconn->prepare($delete_hr);
        $statement->bindValue(":img", $img, PDO::PARAM_STR);
        $statement->bindValue(":a_id", $album_id, PDO::PARAM_STR);
        $statement->execute();

        //delete from high_res
        unlink('high_res_img/'.$_SESSION['collection'].'/'.$a_name.'/'.$img);
    }

    rmdir('high_res_img/'.$_SESSION['collection'].'/'.$a_name);
    rmdir('web_res_img/'.$_SESSION['collection'].'/'.$a_name);

    $delete_album = "DELETE FROM album WHERE id = :a_id;";

    $statement = $dbconn->prepare($delete_album);
    $statement->bindValue(":a_id", $album_id, PDO::PARAM_STR);
    $statement->execute();

    echo "Album was removed.";
?>
