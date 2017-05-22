<?php
    $db = pg_connect("  host=localhost
                        dbname=photosite
                        user=ps
                        password=Lasagna1
                    ");
    if (!$db) {
      echo "An error occurred connecting to db.\n";
      exit;
    }
?>
