<?php
    session_start();
    require('db.php');

    # This is all temporary information that will be removed when we are finished. It just prints the varables that are held by the session and the form
    /*
    print_r($_SESSION);
    echo "<br>";
    print_r($_POST);
    echo "<br>";
    */

    # If the values are set that means the user is trying to sign up. The passwords are checked to make sure they match and if they do the user is registered.
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Langlearn</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css"
    integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link rel="stylesheet" href="css/app.css">
</head>
<body class="">
    <nav class="navbar navbar-dark bg-primary navbar-expand sticky-top">
        <a class="navbar-brand " href="index.php">Langlearn</a>
        <div class="collapse navbar-collapse ">
            <div class="navbar-nav ml-auto">
                <a class="btn nav-item nav-link" href="login.php">Log In</a>
            </div>
        </div>

    </nav>

    <form class="container" action="signup.php" method="POST">
        <h1 class="display-1 mb-4 text-primary text-center">Sign Up</h1>
        <h1 class="display-1 mb-4 text-primary text-center">
            <?php 
            if(isset($_POST["email"]) && isset($_POST["passwd1"]) && isset($_POST["passwd2"])){
                if(check($_POST["passwd1"], $_POST["passwd2"])){
                if($_POST["passwd1"] == "" || $_POST["email"] == ""){
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                    <h4 class=\"alert-heading\">Password or email cannot be null</h4>
                  </div>";
                }else{
                    if(register($_POST["email"], $_POST["passwd1"])){
                        # GO TO THE NEXT PAGE
                        header('Location: http://localhost/CS3141-R02-team9/php/studentMainPage.php');
                    }else{
                        echo "<div class=\"alert alert-warning\" role=\"alert\">
                        <h4 class=\"alert-heading\">This email is already in use</h4>
                      </div>";
                    }
                }
            }else{
                echo "<div class=\"alert alert-warning\" role=\"alert\">
                <h4 class=\"alert-heading\">Passwords don't match</h4>
              </div>";
            }
    }
            ?>
        </h1>

        <div class="form-group mt-4 ">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="passwd1" placeholder="Password">
	  <label for="exampleInputPassword1">Repeat Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="passwd2" placeholder="Repeat Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
</body>
</html>
