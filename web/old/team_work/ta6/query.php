<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>SQL demonstration</title>
    <?php include "head.php"
    ?>
  </head>

  <body class="container">
    <div id="body">
      <div class="row">
        <div class="col-md-12" id="header">
          <h2 id="title">Scripture Resources</h2> </div>
      </div>
      <div class="row" id="center">
        <div class="col-md-4" id="center-middle">
          <?php
  $dbconn = pg_connect("dbname=scripture user=ta_user password=ta_pass");
    if ($dbconn){
        echo " <!--your connected-->";
    }
    else {
        echo "An error occurred connecting to db.\n";
      exit;
    }

    $result = pg_query($dbconn, "SELECT * FROM scripture WHERE id = 1;");
    if (!$result) {
      echo "An error occurred query.\n";
      exit;
    }

    while ($row = pg_fetch_row($result)) {
      echo "<span style='font-weight: bold;'>$row[0] $row[1]:$row[2]</span> -  $row[3]";
      echo "<br /><br/>\n";
    }

    $result = pg_query($dbconn, "SELECT * FROM topic;");
    if (!$result) {
      echo "An error occurred query.\n";
      exit;
    }
  ?>
    <form method="post" action="write_out.php">
    <?php
    while ($row = pg_fetch_row($result)) {
      echo '<input type="checkbox" style="font-weight: bold;" name="att[]" value="';
      echo $row[1].'">'.$row[1];
      echo "<br />\n";
    }
  ?>
        <button type="submit">Add</button>
            </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" id="footer"></div>
      </div>
    </div>
  </body>

</html>
