<?php session_start(); ?>
<nav class="navbar navbar-inverse">
  <div class="conatiner">
    <ul class="nav navbar-nav">
      <?php
        $file = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
      ?>
    <li><a href="index.php"
        <?php if ($file === 'index') echo 'class="active"'?>>
        Home</a></li>
    <li><a href="collection_view.php"
        <?php if ($file === 'collection_view') echo 'class="active"'?>>
        Clients</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="login.php">
          <span class="glyphicon glyphicon-user"></span>Brock.Alli</a></li>
    </ul>
  </div>
</nav>
