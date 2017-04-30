<nav class="navbar navbar-inverse">
  <div class="conatiner-fluid">
    <ul class="nav navbar-nav">
      <?php
        $file = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
      ?>
      <li><a href="index.php"
        <?php if ($file === 'index') echo 'class="active"'?>>
        About</a></li>
      <li><a href="assignments.php"
        <?php if ($file === 'assignments') echo 'class="active"'?>>
        Assignments</a></li>
    </ul>
  </div>
</nav>
