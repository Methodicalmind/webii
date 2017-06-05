<?php
    $dbconn = pg_connect("dbname=scripture user=ta_user password=ta_pass");
    if ($dbconn){
        echo " <!--your connected-->";
    }
    else {
        echo "An error occurred connecting to db.\n";
      exit;
    }
?>
