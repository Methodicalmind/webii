<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }
    include '../dbconn.php';

    $query = "SELECT file_name, img_order FROM web_res
              WHERE album_id = :a_id
              ORDER BY img_order;";
$statement = $dbconn->prepare($query);
$statement->bindValue(":a_id", $_SESSION['album_id'], PDO::PARAM_STR);
$statement->execute();

$results = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<button id="save_order" class="btn btn-md btn-yellow">Save Order</button>
<button id="add_photos" class="btn btn-md btn-yellow">Add Photos</button>
<button id="delete_selected" class="btn btn-md btn-yellow">Delete Selected</button>
<button id="make-cover-photo" class="btn btn-md btn-yellow">Make Cover Photo</button>
<div class="grid grid-admin">
<?php
    foreach ($results as $row) {
    echo '<div class="grid-item">
            <img src="web_res_img/'.$_SESSION['collection'].'/'.
            $_SESSION['album'].'/'.$row['file_name'].'">
          </div>';
    }
?>
</div>
<script src="../js/admin-packery.js"></script>
