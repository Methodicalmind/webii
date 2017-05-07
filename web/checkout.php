<html>
  <head>
    <?php include 'head.php'; ?>
    <title>Store</title>
  </head>
  <body>
    <div class="container">
      <?php include 'nav.php'; ?>
      <h1>Checkout</h1>
      <form method="post" action="confirm.php" id="confirm" >
        <div class="form-group row">
        <div class="col-10">
            First Name:<input class="form-control" type="text" name="fname"><br>
            Last Name:<input class="form-control" type="text" name="lname"><br>
            Street:<input class="form-control" type="text" name="street"><br>
            City:<input class="form-control" type="text" name="city"><br>
            State:<input class="form-control" type="text" name="state"><br>
            Zip:<input class="form-control" type="text" name="zip"><br>
        </div>
        <button type="submit" class="btn btn-lg btn-yellow">Confirm</button>
      </form>
    </div>
  </body>
</html>
