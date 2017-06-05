<?php session_start(); ?>
<html>
    <head>
        <?php include "head.php"?>
    </head>
    <body>
    <div class="container">
    <h1>Site Admin Portal</h1>
    <form method="post" action="authenticate.php"
          class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">
        <div class="form-group row">
          <div class="col-10">
            <label for="username" class="col-2 col-form-label">Username</label>
            <input class="form-control" type="text" id="username" name="username">
            <label for="password" class="col-2 col-form-label">Password</label>
            <input class="form-control" type="password" id="password" name="pass">
            <br/>
            <button type="submit" value="login"
                    class="btn btn-lg btn-yellow pull-right">login</button>
          </div>
        </div>
    </form>
    </div>
    </body>
</html>
