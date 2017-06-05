<?php
    // server should keep session data for AT LEAST 2 days
    ini_set('session.gc_maxlifetime', 172800);

    // each client should remember their session id for EXACTLY 2 days
    session_set_cookie_params(172800);
    session_start();
    include "dbconn.php";

    $_SESSION['collection'] = $_POST['collection'];
    $_SESSION['album'] = $_POST['album'];
    $_SESSION['cover_photo'] = $_POST['img'];
    $_SESSION['user'] = "visitor";

    $pass = $_POST['pass'];

    $query = 'SELECT album_salt FROM collection WHERE name = :c_name;';
    $statement = $dbconn->prepare($query);
    $statement->bindValue(":c_name", $_SESSION['collection'], PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if($result['album_salt'] != '') {
        if (password_verify($pass, $result['album_salt'])) {
            header("Location: admin/client_collection_view.php");
            die();
        }
        else {
            session_destroy();
            echo "access denied.";
        }
    }
    else {
        header("Location: admin/client_collection_view.php");
        die();
    }
?>
