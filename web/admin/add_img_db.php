<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }

    include "../dbconn.php";

    $insert_hr = "INSERT INTO high_res VALUES (
                    DEFAULT,
                    :name,
                    :file_name,
                    :a_id,
                    :date
                );";
    $insert_wr = "INSERT INTO web_res VALUES (
                    DEFAULT,
                    :name,
                    :file_name,
                    DEFAULT,
                    :a_id,
                    :date,
                    :date
                );";

    $today = date("Y-m-d");
    $srcPath = "high_res_img/".$_SESSION['collection'].'/'.$_SESSION['album'].'/';

    $source_img = [];

    $file_count = 0;
    $srcDir = opendir($srcPath);
    while($readFile = readdir($srcDir))
    {
        if($readFile != '.' && $readFile != '..')
        {
            $source_img[$file_count] = $readFile;
            $file_count++;
        }
    }

    closedir($srcDir);

    foreach($source_img as $img) {
        //insert to both places but only upload to high res
        try {
            $statement = $dbconn->prepare($insert_hr);
            $statement->bindValue(":name", $img, PDO::PARAM_STR);
            $statement->bindValue(":file_name", $img, PDO::PARAM_STR);
            $statement->bindValue(":a_id", $_SESSION['album_id'], PDO::PARAM_STR);
            $statement->bindValue(":date", $today, PDO::PARAM_STR);
            $statement->execute();
        }
        catch(Exception $e) {
          continue;
        }

        try {
            $statement = $dbconn->prepare($insert_wr);
            $statement->bindValue(":name", $img, PDO::PARAM_STR);
            $statement->bindValue(":file_name", $img, PDO::PARAM_STR);
            $statement->bindValue(":a_id", $_SESSION['album_id'], PDO::PARAM_STR);
            $statement->bindValue(":date", $today, PDO::PARAM_STR);
            $statement->execute();
        }
        catch(Exception $e) {
          continue;
        }
    }
?>
