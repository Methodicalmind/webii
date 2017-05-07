<nav class="navbar navbar-inverse">
  <div class="conatiner">
    <ul class="nav navbar-nav">
      <?php
        $file = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
      ?>
      <li><a href="store.php"
        <?php if ($file === 'store') echo 'class="active"'?>>
        Store</a></li>
      <li><a href="cart.php"
        <?php if ($file === 'cart') echo 'class="active"'?>>
        Cart</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span>
        Christopher Murray</a></li>
    </ul>
  </div>
</nav>
