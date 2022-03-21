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
                <a class="btn nav-item nav-link" href="signup.php">Sign Up</a>
            </div>
        </div>

    </nav>

    <form class="container" action="login.php" method="POST">
        <h1 class="display-1 mb-4 text-primary text-center">Log In</h1>
        

        <div class="form-group mt-4 ">
        <p class=""><?php 
            if(isset($_POST["email"]) && isset($_POST["passwd"])){
                if(login($_POST["email"], $_POST["passwd"])){
                    # move to the main page
                    echo "<div class=\"alert alert-success\" role=\"alert\">
                    <h4 class=\"alert-heading\">Login Successful</h4>
                  </div>";
                    $_SESSION["email"] = $_POST["email"];
                    header('Location: http://localhost/php/MainPage.php');
                }else{
                    echo "<div class=\"alert alert-danger\" role=\"alert\">
                    <h4 class=\"alert-heading\">Login Failed</h4>
                    <hr>
                    <p>There was a problem logging in. Check your email and password or create an account.</p>
                  </div>";
                }
            }
        ?></p>
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" name="passwd" id="exampleInputPassword1" placeholder="Password">
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
