<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }
    include "../dbconn.php";
    $query_albums = "SELECT id, name from album WHERE collection_id =
                    (SELECT id FROM collection WHERE name = :c_name);";
    $statement = $dbconn->prepare($query_albums);
    $statement->bindValue(":c_name", $_SESSION['collection'], PDO::PARAM_STR);
    $statement->execute();

    $albums = $statement->fetchALL(PDO::FETCH_ASSOC);
    $count = 0;
    //generate nav
    echo '<nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="conatiner-fluid">
            <ul class="nav navbar-nav">';
    foreach($albums as $row){
        if($count == 0) {
            echo '<li><a href="#" album-id="'.$row['id'].'" class="active">'
                  .$row['name'].'</a></li>';
        }
        else {
            echo '<li><a href="#" album-id="'.$row['id'].'">'.$row['name'].'</a></li>';
        }
        $count++;
    }
    echo '</ul><ul class="nav navbar-nav navbar-right">
            <li><a href="../collection_view.php">Collections</a></li></ul>
            </div></nav>';
?>
