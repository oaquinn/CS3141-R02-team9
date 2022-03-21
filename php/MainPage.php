<?php
session_start();
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

<body class="">
    <nav class="navbar navbar-dark bg-primary navbar-expand sticky-top">
        <a class="navbar-brand " href="index.php">Langlearn</a>
        <div class="collapse navbar-collapse ">
            <div class="navbar-nav ml-auto">
                <a class="btn nav-item nav-link" href="login.php">Sign Out</a>
            </div>
        </div>
    </nav>
    <div id="page-container" class="container">
        <header class="pb-5 pt-5">
            <h1 class="display-5 mb-4">My Homepage</h1>
            <a href="Profile Splash.php" class="btn btn-primary btn-lg">My Profile</a>
        </header>

        <!--- Source code for To-Do List: https://bbbootstrap.com/snippets/todo-task-list-badges-71324362 -->
        <div id="to-do-list" class=" d-flex justify-content-around">
            <div class="column">
                <div class="col-md-16">
                    <div class="card-hover-shadow-2x mb-3 card">
                        <div class="card-header-tab card-header">
                            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="fa fa-tasks"></i>&nbsp;My To-Do List</div>
                        </div>
                        <div class="scroll-area-sm">
                            <perfect-scrollbar class="ps-show-limits">
                                <div style="position: static;" class="ps ps--active-y">
                                    <div class="ps-content">
                                        <ul class=" list-group list-group-flush">
                                            <li class="list-group-item">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-2">
                                                            <div class="custom-checkbox custom-control"> <input class="custom-control-input" id="exampleCustomCheckbox12" type="checkbox"><label class="custom-control-label" for="exampleCustomCheckbox12">&nbsp;</label> </div>
                                                        </div>
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Practice tones<div class="badge btn-outline-success">Done</div>
                                                            </div>
                                                            <div class="widget-subheading"><i>By Teacher</i></div>
                                                        </div>
                                                        <div class="widget-content-right"> <button class="border-0 btn-transition btn btn-outline-success"> <i class="fa fa-check"></i></button> <button class="border-0 btn-transition btn btn-outline-danger"> <i class="fa fa-trash"></i> </button> </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="todo-indicator bg-focus"></div>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-2">
                                                            <div class="custom-checkbox custom-control"><input class="custom-control-input" id="exampleCustomCheckbox1" type="checkbox"><label class="custom-control-label" for="exampleCustomCheckbox1">&nbsp;</label></div>
                                                        </div>
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Review 一边。。。一边。。。 sentence structure</div>
                                                            <div class="widget-subheading">
                                                                <div>By Me <div class="badge badge-pill badge-info ml-2">New</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-right"> <button class="border-0 btn-transition btn btn-outline-success"> <i class="fa fa-check"></i></button> <button class="border-0 btn-transition btn btn-outline-danger"> <i class="fa fa-trash"></i> </button> </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </perfect-scrollbar>
                        </div>
                        <div class="d-block text-right card-footer"><button class="mr-2 btn btn-link btn-sm">Cancel</button><button class="btn btn-primary">Add Task</button></div>
                    </div>
                </div>
            </div>

            <div id="friends" class="column">
                <ul class="list-group">
                    <p></p>
                    <p></p>
                    <p style="text-align:center;"><b>Friends</b></p>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Fred
                        <span class="badge badge-primary badge-pill">14</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Samantha
                        <span class="badge badge-primary badge-pill">2</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Zhang
                        <span class="badge badge-primary badge-pill">1</span>
                    </li>
                </ul>
            </div>

            <div class="column">
                <style>
                    #putlogo {
                        position: relative;

                    }

                    #putlogo img {
                        width: 300px;
                        height: 300px;
                    }
                </style>

                <div id="putlogo">
                    <img src="../media/logo.png" />
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


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>

</html>