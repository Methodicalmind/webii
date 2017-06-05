<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }
//    include "../dbconn.php";
//    $collection = htmlspecialchars($_POST["collection"]);
//    $selected_album = htmlspecialchars($_POST["selected_album"]);
//    $query = "Select wr.id AS web_id,
//                     wr.name AS web_name,
//                     wr.img_order,
//                     wr.file_name,
//                      a.name AS album_name,
//                      c.name AS collection_name
//               FROM album a
//               RIGHT JOIN collection c ON a.collection_id = c.id
//               RIGHT JOIN web_res wr ON wr.album_id = a.id
//               ORDER BY wr.img_order;";
    //WHERE a.name = :selected_album
//    $statement = $dbconn->prepare($query);
    //$statement->bindValue(":selected_album", $selected_album, PDO::PARAM_STR);
//    $statement->execute();
//
//    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<head>
    <?php include "admin_head.php"; ?>
    <script src='https://masonry.desandro.com/masonry.pkgd.js'></script>
</head>
<nav class="navbar navbar-inverse">
  <div class="conatiner-fluid">
    <ul class="nav navbar-nav">
      <?php
        $file = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
      ?>
      <li><a href="manage_collection.php"
        <?php if ($file === 'manage_collection') echo 'class="active"'?>>
        Go Back</a></li>
    </ul>
      <div>Your are viewing as client</div>
  </div>
</nav>
<?php include "../client/client_collection_view.php"; ?>
