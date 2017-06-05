<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }
    include "../dbconn.php";

    $query = "SELECT id, name FROM album WHERE collection_id =
             (SELECT id FROM collection WHERE name = :c_name);";

    $statement = $dbconn->prepare($query);
    $statement->bindValue(":c_name", $_SESSION['collection'], PDO::PARAM_STR);
    $statement->execute();

    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
    <head>
      <?php include "admin_head.php"; ?>
      <script src='https://unpkg.com/packery@2/dist/packery.pkgd.js'></script>
      <script src='https://unpkg.com/draggabilly@2/dist/draggabilly.pkgd.js'>
      </script>
      <script src="../js/dropzone.js"></script>
      <script>
        var Dropzone = require("enyo-dropzone");
        Dropzone.autoDiscover = false;

          function loadAlbumDefault() {
              $("#album_1").click();
          }
          function displayAlbum(e) {
            var a_id = e.getAttribute("album-id");
            var pd = 'album_id=' + a_id;
            $.ajax({
                type: 'POST',
                url: 'album_session.php',
                data: pd,
                success: function (data) {
                    $.ajax({
                        url: 'display_selected_album.php',
                        success: function (data) {
                            $(".loaded_php").html(data);
                        },
                        error: function(data){
                            alert("error check network connection");
                        }
                    });
                },
                error: function(data){
                    alert("error check network connection");
                }
            });
        }
      </script>
    </head>
    <body onload="loadAlbumDefault()">
        <?php include "admin_nav.php"; ?>
        <!-- side menu bar with cover photo and albums listed -->
        <div class="col-lg-3 col-md-3 col-sm-3 side_menu"
             style="border-right: solid 1px #000;">
        <?php
            echo '<div class="flex-between"><h3>'.$_SESSION['collection'].'</h3>
                  <span class="glyphicon glyphicon-lock lock"></span></div>';
        ?>
<!--
        <button onclick="editCollectionName()">
        <span class="glyphicons glyphicons-pencil"></span></button>
-->
        <?php
            echo '<img id="cover" src="web_res_img/'.$_SESSION['collection'].'/';
            echo $_SESSION['album'].'/'.$_SESSION['cover_photo'].'"';
            echo 'class="col-lg-12 col-md-12 col-sm-12">';
        ?>
        <ul id="sortable" class="col-lg-3 col-md-3 col-sm-3">
            <?php
                $i = 1;
                foreach ($results as $row) {
echo '<li class="ui-state-default flex-between">
<a id="album_'.$i.'" onclick="displayAlbum(this)" album-id="'.$row['id'].'">
<span class="glyphicon glyphicon-resize-vertical"></span> '.$row['name'].'</a>
    <div id="album-options">
    <span class="glyphicon glyphicon-trash trash" album-id="'.$row['id'].'"></span>
    </div>
</li>';
                    $i++;
                }
            ?>
            <li class="ui-state-default ui-state-disabled new-album-list-item flex-between">
                <span class="glyphicon glyphicon-plus" id="add_album"></span>
                <input type="text" placeholder="e.g. Reception" id="new_album">
            </li>
        </ul>

        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $('.trash').click(function(){
                var exsist = $(this).siblings();
                if (!confirm('This will remove all Images and Album. Are you sure?'))
                {
                    return;
                }
                var a_id = $(this).attr("album-id");
                var delete_request = $.ajax({
                    type: 'post',
                    url: 'delete_album.php',
                    data: {a_delete: a_id}
                });
                delete_request.done(function(data) {
                   alert(data);
                    window.location.href = "manage_collection.php";
                });
                delete_request.fail(function(data) {
                   alert("an error occured: " + data);
                });
            });
            $('.lock').click(function(){
                var salt = prompt("Create Album Password:");
                while(salt.length < 6) {
                    salt = prompt("Create Album Password at least 6 characters in length:");
                }
                var salt_request = $.ajax({
                    type: 'post',
                    url: 'salt_collection.php',
                    data: {salt: salt}
                });
                salt_request.done(function(data) {
                   alert(data);
                });
                salt_request.fail(function(data) {
                   alert("an error occured: " + data);
                });
            });
            $('#add_album').click(function(e) {
                var an = $('#new_album').val();
                if(an == '') {
                    alert("Album Name cannot be left blank.");
                    return;
                }
                pd = "a_name=" + an;
                $.ajax({
                    type: 'POST',
                    url: "make_album.php",
                    data: pd,
                    success: function (data) {
                        alert(data);
                        window.location.href = "manage_collection.php";
                    },
                    error: function(data){
                        alert("an error occured: " + data);
                    }
                });
            });
          $( function() {
            $( "#sortable" ).sortable({
                placeholder: "ui-state-highlight"
            });
            $( "#sortable" ).disableSelection();
          });
        </script>


    <a href="client_preview.php" id="client-view-btn"><button>Preview</button></a>
        </div>
        <!-- album title and add photos -->
        <div class="col-lg-offset-3 col-md-offset-3  col-sm-offset-3 col-lg-9 col-md-9 col-sm-9 header"></div>
        <!-- section to arrange picture order -->
        <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3"
             style="clear: both;">
            <div class="loaded_php"></div>
        </div>
    </body>
</html>
