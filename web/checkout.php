<?php session_start(); ?>
<html>
  <head>
    <?php include 'head.php'; ?>
    <script type="text/javascript">
      function validate(){
        if (document.getElementById("fname").value == ""){
          alert("Enter a First Name");
          return false;
        }
        if (document.getElementById("lname").value == ""){
          alert("Enter a Last Name");
          return false;
        }
        if (document.getElementById("street").value == ""){
          alert("Enter a Street");
          return false;
        }
        if (document.getElementById("city").value == ""){
          alert("Enter a City");
          return false;
        }
        if (document.getElementById("state").value == ""){
          alert("Enter a State");
          return false;
        }
        if (document.getElementById("zip").value == ""){
          alert("Enter a Zip");
          return false;
        }
        return true;
      }
    </script>
    <title>Store</title>
  </head>
  <body>
    <div class="container">
      <?php include 'nav.php'; ?>
      <h1>Checkout</h1>
      <form method="post" action="confirm.php" id="confirm"
            onsubmit="return validate()">
        <div class="form-group row">
        <div class="col-10">
            First Name:
            <input class="form-control" type="text" name="fname" id="fname"><br>
            Last Name:
            <input class="form-control" type="text" name="lname" id="lname"><br>
            Street:
            <input class="form-control" type="text" name="street" id="street"><br>
            City:
            <input class="form-control" type="text" name="city" id="city"><br>
            State:
            <input class="form-control" type="text" name="state" id="state"><br>
            Zip:
            <input class="form-control" type="text" name="zip" id="zip"><br>
        </div>
        <button type="submit" class="btn btn-lg btn-yellow">Confirm</button>
      </form>
    </div>
  </body>
</html>
