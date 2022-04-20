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
?>
<ul class=" list-group list-group-flush">
    <?php printSubmit($_SESSION['email']); ?>
</ul>