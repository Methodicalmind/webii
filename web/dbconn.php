<?php
    $db = pg_connect("  host=localhost
                        dbname=photosite
                        user=postgres
                        password=Spiderman11
                    ");
    if (!$db) {
      echo "An error occurred connecting to db.\n";
      exit;
    }
?>
