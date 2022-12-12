<?php
    session_start();
    require('db.php');

if(isset($_POST['uploadSubmit'])){
    if($_POST['crn'] != '' && $_POST['fileName'] != '' & $_POST['url'] != ''){
        if(addAssignment($_POST['crn'], $_POST['fileName'], $_POST['url'], $_SESSION['email'])){
            print "success";
        }else{
            print "failure";
        }
    }else{
        print "cant enter null";
    }
}

if(isset($_POST['gradeSubmit'])){
    parse_str($_POST['gradeSubmit'], $rs);
    if($_POST[$rs['name']] != ''){
        if(gradeAssignment($rs['CRN'], $rs['email'], $_POST[$rs['name']], $rs['name'])){
            echo 'success';
        }else{
            echo 'failure';
        }
    }else{
        echo 'Points cannot be empty';
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
    <link rel="stylesheet" href="css/mainPage.css">
</head>
<style>
#uploadform {
  border:  thin solid grey;
padding: 20px;
border-radius: 5px;
}
</style>
<body class="">
    <nav class="navbar navbar-dark bg-primary navbar-expand sticky-top">
        <a class="navbar-brand " href="index.php">Langlearn</a>
        <div class="collapse navbar-collapse ">
            <div class="navbar-nav ml-auto">
                <form action="index.php" method="post">
                    <input class="btn nav-item nav-link" type="submit" name="Sign Out" value="Sign Out">
                </form>
            </div>
        </div>
    </nav>
    <div id="page-container" class="container">
        <header class="pb-5 pt-5">
            <h1 class="display-5 mb-4">My Homepage</h1>
        </header>

        <!--- Source code for To-Do List: https://bbbootstrap.com/snippets/todo-task-list-badges-71324362 -->
        <div id="to-do-list" class=" d-flex justify-content-around">
            <div class="column">
                <div class="col-md-16">
                    <div class="card-hover-shadow-2x mb-3 card">
                        <div class="card-header-tab card-header">
                            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="fa fa-tasks"></i>&nbsp;Students Turn-in bin</div>
                        </div>
                        <div class="scroll-area-sm">
                            <perfect-scrollbar class="ps-show-limits">
                                <div style="position: static;" class="ps ps--active-y">
                                    <div class="ps-content">
                                        <ul class=" list-group list-group-flush">
                                            <?php
                                                printGrading($_SESSION['email']);
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </perfect-scrollbar>
                        </div>
                        <div class="d-block text-right card-footer"><button class="mr-2 btn btn-link btn-sm">Cancel</button><button class="btn btn-primary">Add Task</button></div>
                    </div>
                </div>
            </div>


        </div>
        <div class="container">
    <h2 class="display-5 mb-4">Upload Content</h2>

    <section>

      <div class="input-group mb-3">
      
        <div id = "uploadform">
        
          <!-- Select & Upload Button -->
    <form  method="post" action="teacherMainPage.php">
        <label for="crn">Enter CRN:</label>
        <input type="text" id="crn" name="crn"><br>
        <label for="fileName">Enter File Name:</label>
        <input type="text" id="fileName" name="fileName"><br>
        <label for="url">Enter URL:</label>
        <input type="text" id="url" name="url"><br>
        <input type="submit" name="submit">
        </form>
          
        </div>

      </div>
  </div>
  <div class="">
            <h2> Notifications </h2>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Welcome to Langlearn!
                </li>
            </ul>
        </div>
  </div>

        
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>

</html>