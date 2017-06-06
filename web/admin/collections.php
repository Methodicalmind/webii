<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: ../collection_view.php");
        die();
    }
    include "../dbconn.php";
    $queryCollections = "SELECT c.id, c.name AS c_name, a.name AS a_name
                            FROM collection c
                            RIGHT JOIN album a ON a.collection_id = c.id;";

    $statement = $dbconn->prepare($queryCollections);
    $statement->execute();
    $collections = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<html>
    <head>
        <?php include "admin_head.php"; ?>
        <script src="../js/jquery.min.js"></script>
        <script type="text/javascript">
            function showForm() {
                document.getElementById('overlay').style.display = "block";
                document.getElementById('overlay-form').style.display = "block";
            }
            function cancelForm() {
                document.getElementById('overlay').style.display = "none";
                document.getElementById('overlay-form').style.display = "none";
                document.getElementById('add_collection').reset();

            }
            function manageCollection(e) {
                var parse = e.getAttribute("src");
                var path = parse.split('/');
                var pd = 'collection=' + path[1];
                pd += '&album=' + path[2];
                pd += '&cp=' + path[3];
                $.ajax({
                    type: 'POST',
                    url: 'collection_session.php',
                    data: pd,
                    success: function (data) {
                        window.location.href = "manage_collection.php";
                    },
                    error: function(data){
                        alert("error check network connection");
                    }
                });
            }
        </script>
</head>
<body>
    <div class="container-fluid">
        <?php include "admin_nav.php"; ?>
        <div class="container">
            <div class="collection-header flex-between">
                <h2>Collections</h2>
                <button class="btn btn-lg" onclick="showForm()" id="btn-new-collection">
                    <span class="glyphicon glyphicon-plus"></span>
                    New Collection</button>
            </div>
            <div class="collection_thumbnail">
                <?php
                    $i = 0;
                    $last_c = '';
                    foreach ($collections as $collect) {
						echo '<div><img onclick="manageCollection(this)" src="web_res_img/'.
							 $collect['c_name'].'/'.$collect['a_name'].'/default.jpg">';
                        echo '<br/><h2>'.$collect['c_name'].'</h2></div>';
                    }
                ?>
            </div>
        </div>
    </div>




<!--        hidden form to add collections-->
        <div id="overlay" style="display: none;"></div>
        <div id="overlay-form" class="col-lg-offset-3 col-lg-6 col-md-offset-3
                col-md-6 col-sm-offset-2 col-sm-8" style="display: none;">
                <button class="btn btn-lg close_form pull-right" onclick="cancelForm()">
                    <span class="glyphicon glyphicons-remove"></span>cancel</button>
            <form method="post" action="make_collect.php" id="add_collection">
                <h3 id="form-title">Create New Collection</h3>
                <div class="form-group">
                    <label for="collection_name">Collection Name</label>
                    <input type="text" class="form-control" id="collection_name"
                           placeholder="e.g. Alli & Chris" name="collection_name">
                    <br/>
                    <label for="album_name">Default Album</label>
                    <input type="text" class="form-control" id="album_name"
                           placeholder="If left blank default is: Proofs." name="album_name">
                </div>
                <button class="btn btn-lg btn-collection-submit" type="submit">Create</button>
            </form>
            <script>
                $('#add_collection').on('submit', function (e) {
                    e.preventDefault();
                    var cn = $('#collection_name').val();
                    var an = $('album_name').val();
                    if(cn == '') {
                        alert("Collection Name cannot be left blank.");
                        return;
                    }
                    if(an == '')
                        an.val() = "Proofs";

                    var formData = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        cache:false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (data) {
                    document.getElementById('overlay').style.display = "none";
                    document.getElementById('overlay-form').style.display = "none";
                    document.getElementById('add_collection').reset();
                    window.location.href = "manage_collection.php";
//                    alert(data);
                        },
                        error: function(data){
                    document.getElementById('overlay').style.display = "none";
                    document.getElementById('overlay-form').style.display = "none";
                    document.getElementById('add_collection').reset();
                    alert("an error occured: " + data);
                    window.location.href = "collections.php";
                        }
                    });
                });
            </script>
        </div>
    </body>
</html>
