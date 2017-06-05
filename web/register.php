<?php session_start(); ?>
<html>
    <head>
        <?php
            include "head.php";
            $page = "signup";
        ?>
    </head>
    <body>
    <div class="container">
    <h1>Make an account</h1>
    <form method="post" action="signup.php"
          class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">
        <div class="form-group row">
          <div class="col-10">
            <label for="email" class="col-2 col-form-label">Email</label>
            <input class="form-control" type="text" id="email" name="email">
            <label for="username" class="col-2 col-form-label">Username</label>
            <input class="form-control" type="text" id="username" name="username">
            <label for="password1" class="col-2 col-form-label">Password</label>
            <input class="form-control" type="password" id="password1" name="password">
            <label for="password2" class="col-2 col-form-label">
                Confirm Password</label>
            <input class="form-control" type="password" id="password2"
               onchange="passwordsMatch()"><br/>
            <button type="submit"
                class="btn btn-lg btn-yellow pull-right">register</button>
          </div>
        </div>
    </form>
    </div>
    </body>
</html>
