<?php
    // server should keep session data for AT LEAST 2 days
    ini_set('session.gc_maxlifetime', 172800);

    // each client should remember their session id for EXACTLY 2 days
    session_set_cookie_params(172800);
    session_start();
    include "dbconn.php";

    $password = $_POST['pass'];
    $user = htmlspecialchars($_POST['username']);
    $_SESSION['user'] = $user;

    $query = 'SELECT * FROM "user" WHERE username = :user;';
    $statement = $dbconn->prepare($query);
    $statement->bindValue(":user", $user, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if (password_verify($password, $result['salt'])) {
        header('Location: admin/collections.php');
        die();
    }
    else {
        echo '<div>Information Provided was Incorrect. Try Again.</div>';
        header('Location: login.php');
        die();
    }
?>
