<?php session_start(); ?>
<html>
  <head>
    <?php include 'head.php'; ?>
    <title>Store</title>
  </head>
  <body>
    <div class="container">
      <?php include 'nav.php'; ?>
      <h1>Shopping Cart</h1>
      <?php
        $items = $_POST["items"];
        if($items == null){
          echo "<hr><p>Your cart is empty</p><hr>";
          echo '<div class="pull-left">
                  <a href="index.php">Continue Shopping</a>
                </div>';
          exit();
        }
        else {
          $total = 0;
          echo '<table class="table table-hover">';
          echo '<tr><th>Item</th><th>Price</th></tr>';
          foreach($items as $value) {
            if(isset($value)) {
              echo '<tr>';
              switch($value) {
                case 'duc':
                  echo '<td><img src="img/duc.jpg" class="product"></td>';
                  echo '<td>$16,999</td>';
                  $total += 16999;
                  $_SESSION["duc"] = "true";
                  break;
                case 'gxr':
                  echo '<td><img src="img/gxr.jpg" class="product"></td>';
                  echo '<td>$17,895</td>';
                  $total += 17895;
                  $_SESSION["gxr"] = "true";
                  break;
                case 'bmw':
                  echo '<td><img src="img/bmw.jpg" class="product"></td>';
                  echo '<td>$15,695</td>';
                  $total += 15695;
                  $_SESSION["bmw"] = "true";
                  break;
                case 'cbr':
                  echo '<td><img src="img/cbr.jpg" class="product"></td>';
                  echo '<td>$19,799</td>';
                  $total += 19799;
                  $_SESSION["cbr"] = "true";
                  break;
              }
              echo '</tr>';
            }
          }
          echo '</table>';
        }
      ?>
      <div class="pull-left">
        <a href="index.php">Continue Shopping</a>
      </div>
      <div class="pull-right">
        <h2><?php echo 'Total:    $'.number_format($total, 2); ?></h2>
        <form method="post" action="checkout.php" id="checkout">
          <button type="submit" class="btn btn-lg btn-yellow">Checkout</button>
        </form>
      </div>
    </div>
  </body>
</html>
