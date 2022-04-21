<?php
    require('db.php');
    session_start();

    if(isset($_POST['submit'])){
        parse_str($_POST['submit'], $value);
        if($_POST[$value['name']] != ''){
            submitAssignment($value['CRN'], $_SESSION['email'], $value['name'], $_POST[$value['name']]);
        }else{
            echo 'link cannot be null';
        }
    }

if (isset($_POST['submit'])) {
    parse_str($_POST['submit'], $value);
    if ($_POST['link'] != '') {
        submitAssignment($value['CRN'], $_SESSION['email'], $value['name'], $_POST['link']);
        header('Location: http://localhost/php/submit.php');
    } else {
        echo 'link cannot be null';
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Langlearn</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
</head>

<body>
    <nav class="navbar navbar-dark bg-primary navbar-expand sticky-top">
        <a class="navbar-brand " href="studentMainPage.php">Langlearn</a>
        <div class="collapse navbar-collapse ">
            <div class="navbar-nav ml-auto">
                <a class="btn nav-item nav-link" href="login.php">Sign Out</a>
            </div>
        </div>
    </nav>
    <main class="container">
    <h1 class="display-5 mb-4 pt-5">Submit</h1>
        <ul class=" list-group list-group-flush">
            <?php printSubmit($_SESSION['email']); ?>
        </ul>
    </main>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>