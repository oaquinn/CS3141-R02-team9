<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regester for Course</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-dark bg-primary navbar-expand sticky-top">
        <a class="navbar-brand " href="index.php">Langlearn</a>
        <div class="collapse navbar-collapse ">
            <div class="navbar-nav ml-auto">
                <a class="btn nav-item nav-link" href="login.php">Sign Out</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <header class="pt-5">
            <h1 class="display-5 mb-4">Regester for Course</h1>
        </header>
        <main class="">
            <form action="">
                <div>
                    <input type="number" min="1000" placeholder="Enter CRN">
                </div>
                <div class="mt-3">
                    <input class="btn btn-success" type="submit" value="Register">
                    <a href="./studentMainPage.php" class="btn btn-danger">Cancel</a>
                </div>

            </form>

        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>

</html>