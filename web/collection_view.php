<?php
    include "dbconn.php";
    $queryCollections = "SELECT c.id, c.name AS c_name, a.name AS a_name
                            FROM collection c
                            RIGHT JOIN album a ON a.collection_id = c.id;";

    $statement = $dbconn->prepare($queryCollections);
    $statement->execute();
    $collections = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
    <?php include "head.php"?>
    <script>
        function view(e) {
            var pass = prompt("Enter Collection Password:",
                              "click ok if there is no password.");
            var img_src = e.getAttribute('src');
            var parse = img_src.split('/');
            pd = "collection=" + parse[2];
            pd += "&album=" + parse[3];
            pd += "&img=" + parse[4];
            pd += "&pass=" + pass;
            var view_request = $.ajax({
                    type: 'post',
                    url: 'collection_salt.php',
                    data: pd
                });
                view_request.done(function(data) {
                    if(data = "granted") {
                        window.location.href = "admin/client_collection_view.php";
                    }
                    else {
                        alert("denied");
                    }
                });
                view_request.fail(function(data) {
                   alert("an error occured: " + data);
                });
        }
    </script>
</head>
<body>
        <div class="container">
        <?php include "nav.php"; ?>
            <div class="collection-header flex-between">
                <h2>Collections</h2>
            </div>
            <div class="collection_thumbnail">
                <?php
                    $i = 0;
                    $last_c = '';
                    foreach ($collections as $collect) {
						echo '<div><img onclick="view(this)" src="admin/web_res_img/'.
							 $collect['c_name'].'/'.$collect['a_name'].'/default.jpg">';
                        echo '<br/><h2>'.$collect['c_name'].'</h2></div>';
                    }
                ?>
            </div>
        </div>
    </body>
</html>
