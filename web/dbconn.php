<?php
    session_start();
    include "heroku_cred.php";
    try {
        $dbconn = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $user, $pass);
        $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
        echo "Error connecting to the db. Details: $ex";
        die();
    }
?>
