<nav class="navbar navbar-inverse">
  <div class="conatiner">
    <ul class="nav navbar-nav">
      <?php
        $file = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
      ?>
      <li><a href="index.php"
        <?php if ($file === 'index') echo 'class="active"'?>>
        Store</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span>
        Christopher Murray</a></li>
    </ul>
  </div>
</nav>
