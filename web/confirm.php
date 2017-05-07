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
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $street = $_POST["street"];
        $city = $_POST["city"];
        $st = $_POST["state"];
        $zip = $_POST["zip"];

        echo '<h3>Shipping Info:</h3><hr>';
        echo '  '.$fname.' '.$lname.'<br>'.$street.'<br>';
        echo $city.', '.$st.'<br>'.$zip.'<br><br>';

        $total = 0;
        echo '<table class="table table-hover">';
        echo '<tr><th>Item</th><th>Price</th></tr>';
        foreach($_SESSION["items"] as $key=>$value) {
          if(isset($value)) {
            echo '<tr>';
            switch($value) {
              case 'duc':
                echo '<td><img src="img/duc.jpg" class="product"></td>';
                echo '<td>$16,999</td>';
                $total += 16999;
                break;
              case 'gxr':
                echo '<td><img src="img/gxr.jpg" class="product"></td>';
                echo '<td>$17,895</td>';
                $total += 17895;
                break;
              case 'bmw':
                echo '<td><img src="img/bmw.jpg" class="product"></td>';
                echo '<td>$15,695</td>';
                $total += 15695;
                break;
              case 'cbr':
                echo '<td><img src="img/cbr.jpg" class="product"></td>';
                echo '<td>$19,799</td>';
                $total += 19799;
                break;
            }
            echo '</tr>';
          }
        }
        echo '</table>';
      ?>
      <div class="pull-right">
        <h2><?php echo 'Total:    $'.number_format($total, 2); ?></h2>
      </div>
    </div>
  </body>
</html>
