<?php session_start(); ?>
<html>
  <head>
    <?php include 'head.php'; ?>
    <title>Store</title>
  </head>
  <body>
    <div class="container">
      <?php include 'nav.php'; ?>
      <div class="jumbotron">
        <h1>Welcome to Bikezilla</h1>
      </div>
      <form method="post" action="cart.php" id="cart">
        <?php include 'items.php'; ?>
        <button type="submit" class="btn btn-lg btn-yellow">View Cart</button>
      </form>
      <footer class="page">
        <p>page 1 of 1</p>
      </footer>
    </div>
  </body>
</html>
