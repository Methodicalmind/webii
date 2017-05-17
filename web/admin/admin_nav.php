<nav class="navbar navbar-inverse">
  <div class="conatiner">
    <ul class="nav navbar-nav">
      <?php
        $file = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
      ?>
      <li><a href="collections.php"
        <?php if ($file === 'collections') echo 'class="active"'?>>
        Collections</a></li>
      <li><a href="ratings.php"
        <?php if ($file === 'rating') echo 'class="active"'?>>
        Ratings</a></li>
    </ul>
    <div class="dropdown">
        <ul class="nav navbar-nav navbar-right dropdown">
          <li><a href="logout.php">
              <span class="glyphicon glyphicon-user"></span>Brock.Alli</a></li>
        </ul>
    </div>
  </div>
</nav>
