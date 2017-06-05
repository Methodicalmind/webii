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

    $insert_collection = "INSERT INTO collection VALUES (
                            DEFAULT,
                            :collection_name,
                            :date
                          );";
    $insert_album = "INSERT INTO album VALUES (
                        DEFAULT,
                        :date,
                        :album_name,
                        (Select id FROM collection WHERE name = :collection_name)
                    );";

    $today = date("Y-m-d");
    $album = $_POST['album_name'];
    $collection = $_POST['collection_name'];
    $new_collection = str_replace(' ', '_', $collection);
    $_SESSION['collection'] = $new_collection;
    $new_album = str_replace(' ', '_', $album);
    $_SESSION['album'] = $new_album;
    $make_hr = "high_res_img\\".$new_collection."\\".$new_album;
    $make_wr = "web_res_img\\".$new_collection."\\".$new_album;
    $pass = mkdir($make_hr, 0777, TRUE);
    if(!$pass) {
        throwError('could not make collection it already exsists');
    }
    $pass = mkdir($make_wr, 0777, TRUE);
    if(!$pass) {
        throwError('could not make collection it already exsists');
    }


//add collection to db
$statement = $dbconn->prepare($insert_collection);
$statement->bindValue(":collection_name", $new_collection, PDO::PARAM_STR);
$statement->bindValue(":date", $today, PDO::PARAM_STR);
$statement->execute();

//add album and link to collection
$statement = $dbconn->prepare($insert_album);
$statement->bindValue(":date", $today, PDO::PARAM_STR);
$statement->bindValue(":album_name", $new_album, PDO::PARAM_STR);
$statement->bindValue(":collection_name", $new_collection, PDO::PARAM_STR);
$statement->execute();

copy('web_res_img/cover_photo/default.jpg', $make_wr.'default.jpg');

?>
