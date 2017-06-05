<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }
    include "../dbconn.php";

    function throwError($error) {
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array($error => 'ERROR', 'code' => 600)));
    }

    $insert_album = "INSERT INTO album VALUES (
                        DEFAULT,
                        :date,
                        :album_name,
                        (Select id FROM collection WHERE name = :collection_name)
                    );";
    $today = date("Y-m-d");
    $album = $_POST['a_name'];

    $new_album = str_replace(' ', '_', $album);
    $_SESSION['album'] = $new_album;
    $dir_path_hr = "high_res_img\\".$_SESSION['collection']."\\".$new_album;
    $dir_path_wr = "web_res_img\\".$_SESSION['collection']."\\".$new_album;
    $pass = mkdir($dir_path_hr, 0777, TRUE);
    if(!$pass) {
        throwError('could not make album it already exsists');
    }
    $pass = mkdir($dir_path_wr, 0777, TRUE);
    if(!$pass) {
        throwError('could not make album it already exsists');
    }

//add the album to db
$statement = $dbconn->prepare($insert_album);
$statement->bindValue(":date", $today, PDO::PARAM_STR);
$statement->bindValue(":album_name", $new_album, PDO::PARAM_STR);
$statement->bindValue(":collection_name", $_SESSION['collection'], PDO::PARAM_STR);
$statement->execute();

copy('web_res_img/cover_photo/default.jpg', $dir_path_wr.'default.jpg');
echo "album added to db";
?>
