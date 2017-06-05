<?php
session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }

$_SESSION['album_id'] = $_POST['album_id'];

include "../dbconn.php";

$query_album = "SELECT name FROM album WHERE id = :a_id;";

$statement = $dbconn->prepare($query_album);
$statement->bindValue(":a_id", $_SESSION['album_id'], PDO::PARAM_STR);
$statement->execute();

$result = $statement->fetch(PDO::FETCH_ASSOC);

$_SESSION['album'] = $result['name'];
//echo 'album name: '.$_SESSION['album'];
?>
