<?php
    session_start();
    include "../dbconn.php";
?>
<html>
    <head>
    <link rel="stylesheet" type="text/css"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script src='https://unpkg.com/packery@2/dist/packery.pkgd.js'></script>
    <script type="text/javascript">
        function firstAlbum() {
            var a_id = $("li a").first().attr("album-id");
            selectAlbum(a_id);
        }
        function selectAlbum(id) {
            var album_request = $.ajax({
                type: 'post',
                url: 'selected_album.php',
                data: {a_id: id}
            });
            album_request.done(function(data) {
               $(".selected_album").html(data);
            });
            album_request.fail(function(data) {
               alert("an error occured: " + data);
            });
        }
    </script>
    </head>
    <body onload="firstAlbum()">

        <!-- page -->
        <div class="container-fluid">
            <?php include "client_nav.php" ?>
            <div class="col-lg-12 col-md-12 col-sm-12 selected_album"></div>

            <!-- display selected img-->
            <div id="fullscreen">
                <div class="overlay-white"></div>
                <button class="close btn btn-lg">
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
                <img id="fill_img" src="#">
            </div>
        </div>
    </body>
</html>
