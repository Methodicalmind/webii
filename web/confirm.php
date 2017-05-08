<?php session_start(); ?>
<html>
  <head>
    <?php include 'head.php'; ?>
    <title>Store</title>
  </head>
  <body>
    <div class="container">
      <?php include 'nav.php'; ?>
      <h1>Order Confirmation</h1>
      <?php
        $fname = htmlspecialchars($_POST["fname"]);
        $lname = htmlspecialchars($_POST["lname"]);
        $street = htmlspecialchars( $_POST["street"]);
        $city = htmlspecialchars($_POST["city"]);
        $st = htmlspecialchars($_POST["state"]);
        $zip = htmlspecialchars($_POST["zip"]);

        echo '<h3>Shipping Info:</h3><hr>';
        echo '  '.$fname.' '.$lname.'<br>'.$street.'<br>';
        echo $city.', '.$st.'<br>'.$zip.'<br><br>';

        $total = 0;
        echo '<table class="table table-hover">';
        echo '<tr><th>Item</th><th>Price</th></tr>';
        if (isset($_SESSION["duc"])){
          echo '<td><img src="img/duc.jpg" class="product"></td>';
          echo '<td>$16,999</td>';
          $total += 16999;
        }
        if (isset($_SESSION["gxr"])){
          echo '<td><img src="img/gxr.jpg" class="product"></td>';
          echo '<td>$17,895</td>';
          $total += 17895;
        }
        if (isset($_SESSION["bmw"])){
          echo '<td><img src="img/bmw.jpg" class="product"></td>';
          echo '<td>$15,695</td>';
          $total += 15695;
        }
        if (isset($_SESSION["cbr"])){
          echo '<td><img src="img/cbr.jpg" class="product"></td>';
          echo '<td>$19,799</td>';
          $total += 19799;
        }
        echo '</tr>';
        echo '</table>';
      ?>
      <div class="pull-right">
        <h2><?php echo 'Total:    $'.number_format($total, 2); ?></h2>
      </div>
    </div>
  </body>
</html>
