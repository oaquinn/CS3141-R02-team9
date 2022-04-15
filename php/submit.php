<?php
    require('db.php');
    session_start();
    echo 'Session: ';
    print_r($_SESSION);
    echo '<br>';
    echo 'Post: ';
    print_r($_POST);
    echo '<br>';

    if(isset($_POST['submit'])){
        parse_str($_POST['submit'], $value);
        if($_POST['link'] != ''){
            submitAssignment($value['CRN'], $_SESSION['email'], $value['name'], $_POST['link']);
            header('Location: http://localhost/php/submit.php');
        }else{
            echo 'link cannot be null';
        }

    }
?>
<ul class=" list-group list-group-flush">
    <?php printSubmit($_SESSION['email']); ?>
</ul>