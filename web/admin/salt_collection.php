<?php
    session_start();
    include "../dbconn.php";

    $salt = $_POST['salt'];

    $passwordHash = password_hash($salt, PASSWORD_DEFAULT);

    $set_salt = 'UPDATE collection SET album_salt = :salt WHERE name = :c_name;';
    $statement = $dbconn->prepare($set_salt);
    $statement->bindValue(":salt", $passwordHash, PDO::PARAM_STR);
    $statement->bindValue(":c_name", $_SESSION['collection'], PDO::PARAM_STR);
    $statement->execute();

    echo 'collection password set successfully';
?>
