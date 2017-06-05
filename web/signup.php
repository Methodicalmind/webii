<?php
    session_start();
    include "dbconn.php";

    $password = $_POST['password'];
    $user = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $insert = 'INSERT INTO "user" VALUES (
                    DEFAULT,
                    :user,
                    :email,
                    :salt
                );';
    $statement = $dbconn->prepare($insert);
    $statement->bindValue(':user', $user, PDO::PARAM_STR);
    $statement->bindValue(':salt', $passwordHash, PDO::PARAM_STR);
    $statement->bindValue(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    echo '<p>got to here</p>';

    header('Location: admin/collections.php');
?>
