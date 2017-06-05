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
          <h2 id="title">Written to DB</h2> </div>
      </div>
      <div class="row" id="center">
        <div class="col-md-4" id="center-middle">
          <?php
            $topic = $_POST["att"];
            include 'dbconn.php';

          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" id="footer"></div>
      </div>
    </div>
  </body>

</html>
