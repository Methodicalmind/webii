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
        <table class="table table-hover">
        <tr>
          <th>Items</th>
          <th>Description</th>
          <th>Cart</th>
        </tr>
        <tr>
          <td><img class="product" src="img/duc.jpg"></td>
          <td><p>2017 Ducati Panigale 959<br><div id="price">$16,999</div></p></td>
          <td class="center-checkbox">
            <input type="checkbox" name="items[]" value="duc" id="duc"
            <?php if(isset($_SESSION["duc"])) echo 'checked="checked"'?>>
            <label for="duc"></label></td>
        </tr>
        <tr>
          <td><img class="product" src="img/gxr.jpg"></td>
          <td><p>2017 Suzuki GXR1000R<br><div id="price">$17,895</div></p></td>
          <td class="center-checkbox">
            <input type="checkbox" name="items[]" value="gxr" id="gxr"
            <?php if(isset($_SESSION["gxr"])) echo 'checked="checked"'?>>
            <label for="gxr"></label></td>
        </tr>
        <tr>
          <td><img class="product" src="img/cbr.jpg"></td>
          <td><p>2017 Honda CBR1000R<br><div id="price">$19,799</div></p></td>
          <td class="center-checkbox">
            <input type="checkbox" name="items[]" value="cbr" id="cbr"
            <?php if(isset($_SESSION["cbr"])) echo 'checked="checked"'?>>
            <label for="cbr"></label></td>
        </tr>
        <tr>
          <td><img class="product" src="img/bmw.jpg"></td>
          <td><p>2017 BMW 1000R<br><div id="price">$15,695</div></p></td>
          <td class="center-checkbox">
            <input type="checkbox" name="items[]" value="bmw" id="bmw"
            <?php if(isset($_SESSION["bmw"])) echo 'checked="checked"'?>>
            <label for="bmw"></label></td>
        </tr>
        </table>
        <button type="submit" class="btn btn-lg btn-yellow">View Cart</button>
      </form>
      <footer class="page">
        <p>page 1 of 1</p>
      </footer>
    </div>
  </body>
</html>
