<html>
    <head>
    </head>
    <body>
        <?php include "nav.php" ?>
        <h1>Brock.Alli Photography</h1>
        <div class="collection_thumbnail">
            <?php
                include "dbconn.php";
                $result = pg_query($db, "SELECT cover_photo FROM web_res");
                if (!$result) {
                  echo "An error occurred.\n";
                  exit;
                }
                while ($row = pg_fetch_row($result)) {
                  echo "<p>cover photo 1: $row[0]"
                  echo '<p onclick="promptForPassword()">';
                  echo "<br />\n";
                }
            ?>
        </div>
    </body>
</html>
