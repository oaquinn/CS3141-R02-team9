<?php


# CONNECTION - connects to the DB using the proper user
# return - The instance of the database
function connect(){
    $dbh = new PDO("mysql:host=47.6.28.163;dbname=CS3141", "3141", "1234");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}


# LOGIN - Authenticate user 
# @param $user - the username of the given user trying to login
# @param $passwd - the password of the given user trying to login
# return - Will return 1 if the user is in the Datbase and 0 if the user is not
function login($user, $passwd){

    try{
        # Connect to the database
        $db = connect();

        $stmnt = $db->prepare("CALL checkUserEmail(:user)");
        $stmnt->bindParam(":user", $user);

        $stmnt->execute();

        $rs = $stmnt->fetch();

        if($rs[0] == 1){
            $stmnt = $db->prepare("CALL userAuth(:user, :passwd)");

            $stmnt->bindParam(":user", $user);
            $stmnt->bindParam(":passwd", $passwd);

            $stmnt->execute();

            $rs = $stmnt->fetch();

            return $rs[0];
        }else{

            $stmnt = $db->prepare("CALL teacherAuth(:user, :passwd)");

            $stmnt->bindParam(":user", $user);
            $stmnt->bindParam(":passwd", $passwd);

            $stmnt->execute();

            $rs = $stmnt->fetch();

            if($rs[0]) return 2;
        }

        return -1;
        

    }catch(PDOException $e){ # 
        echo "Error! " . $e->getMessage() . ". ";
        return 0;
    }


}


# REGISTER - add user to the database;
# @param $user - The username of the user that is going to be added to the database
# @param $passwd - The password of the user that is going to be added to the database
# return - function will return 0 if the user is already in the system, 1 otherwise 
function register($user, $passwd){

    try{

        $db = connect();

        # This first statement checks the database to make sure that the user is not already registered
        $stmnt = $db->prepare("CALL checkUserEmail(:user)");

        # Bind the username
        $stmnt->bindParam(":user", $user);

        # Execute
        $stmnt->execute();

        # Get the result
        $rs = $stmnt->fetch();

        if($rs[0] == 1){ # This means that the user is already in the system
            return 0;
        }

        # Insert the user into the database
        $stmnt = $db->prepare("CALL registerUser(:user, :passwd)");

        # Bind the varables
        $stmnt->bindParam(":user", $user);
        $stmnt->bindParam(":passwd", $passwd);

        # Execute
        $stmnt->execute();

        # Return a success
        return 1;



    }catch(PDOException $e){
        echo "Error! " . $e->getMessage() . ". ";
        return 0;
    }


}


# PASSWORD CHECK - check if the two passwords match
# @param $passwd1 - The first password the user input
# @param $passwd2 - the second password the user inputs
# return - 1 if the passwords match, 0 otherwise
function check($passwd1, $passwd2){

    if($passwd1 == $passwd2){
        return 1;
    }else{
        return 0;
    }

}

function addAssignment($CRN, $name, $url, $email){

    try{
        $db = connect();

        $stmnt = $db->prepare("CALL validCRN(:CRN, :email)");

        $stmnt->bindParam(":CRN", $CRN);
        $stmnt->bindParam(":email", $email);

        $stmnt->execute();

        $rs = $stmnt->fetch();

        if($rs[0]){
            $stmnt = $db->prepare("CALL addAssignment(:CRN, :fileName, :url)");
            
            $stmnt->bindParam(":CRN", $CRN);
            $stmnt->bindParam(":fileName", $name);
            $stmnt->bindParam(":url", $url);

            $stmnt->execute();

            return 1;

        }else{
            print "Please enter a CRN to a course you are teaching";
            return -1;
        }

        return -1;

    }catch(PDOException $e){
        print "Error: " . $e->getMessage();
        return 0;
    }
}

function printTasks($email){

    try{

        $db = connect();

        $stmnt = $db->prepare("CALL getStudentCourses(:email)");

        $stmnt->bindParam(":email", $email);

        $stmnt->execute();

        $rs = $stmnt->fetchAll();

        $stmnt->closeCursor();

        $completeCheck = $db->prepare("CALL checkCompleted(:CRN, :email)");

        foreach($rs as &$row){
            $stmnt = $db->prepare("CALL getStudentAssignment(:CRN)");
            
            $stmnt->bindParam(":CRN", $row['CRN']);

            $stmnt->execute();

            $as = $stmnt->fetchAll();

            $stmnt->closeCursor();

            $completeCheck->bindParam(":CRN", $row['CRN']);
            $completeCheck->bindParam(":email", $_SESSION['email']);

            $completeCheck->execute();

            $cc = $completeCheck->fetchAll();

            $completeCheck->closeCursor();

            foreach($as as &$innerRow){
                if(count($cc)){
                    $check = 1;
                    foreach($cc as &$sub){
                        if(in_array($innerRow['name'], $sub)){
                            $check = 0;
                        }
                    }
                    if($check){
                        echo '<li class="list-group-item">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">'. $innerRow['CRN'] . ': ' . $innerRow['name'] . '
                                    </div>
                                    <div class="widget-subheading"><a href="' . $innerRow['link'] . '">Link to Assignment</a></div>
                                </div>
                            </div>
                        </div>
                    </li>';
                    }
                }else{
                    echo '<li class="list-group-item">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">'. $innerRow['CRN'] . ': ' . $innerRow['name'] . '
                                    </div>
                                    <div class="widget-subheading"><a href="' . $innerRow['link'] . '">Link to Assignment</a></div>
                                </div>
                            </div>
                        </div>
                    </li>';
                }
            }
            unset($innerRow);
        }
        unset($row);
        unset($cc);


        return 0;

    }catch(PDOException $e){
        print "Error: " . $e->getMessage(); 
        return 0;
    }
}


function printSubmit($email){
    try{

        $db = connect();

        $stmnt = $db->prepare("CALL getStudentCourses(:email)");

        $stmnt->bindParam(":email", $email);

        $stmnt->execute();

        $rs = $stmnt->fetchAll();

        $stmnt->closeCursor();

        $completeCheck = $db->prepare("CALL checkCompleted(:CRN, :email)");

        foreach($rs as &$row){
            $stmnt = $db->prepare("CALL getStudentAssignment(:CRN)");
            
            $stmnt->bindParam(":CRN", $row['CRN']);

            $stmnt->execute();

            $as = $stmnt->fetchAll();

            $stmnt->closeCursor();

            $completeCheck->bindParam(":CRN", $row['CRN']);
            $completeCheck->bindParam(":email", $_SESSION['email']);

            $completeCheck->execute();

            $cc = $completeCheck->fetchAll();

            $completeCheck->closeCursor();

            foreach($as as &$innerRow){
                if(count($cc)){
                    $check = 1;
                    foreach($cc as &$sub){
                        if(in_array($innerRow['name'], $sub)){
                            $check = 0;
                        }
                    }
                    if($check){
                        echo '<li class="list-group-item">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">'. $innerRow['CRN'] . ': ' . $innerRow['name'] . '
                                    </div>
                                    <div class="widget-subheading">
                                        <form action="submit.php" method="post">
                                            <input type="text" name="' . $innerRow['name'] . '">
                                            <button type="submit" name="submit" value="CRN=' . $innerRow['CRN'] . '&name=' . $innerRow['name'] . '">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>';
                    }
                }else{
                    echo '<li class="list-group-item">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">'. $innerRow['CRN'] . ': ' . $innerRow['name'] . '
                                    </div>
                                    <div class="widget-subheading">
                                        <form action="submit.php" method="post">
                                            <input type="text" name="' . $innerRow['name'] . '">
                                            <button type="submit" name="submit" value="CRN=' . $innerRow['CRN'] . '&name=' . $innerRow['name'] . '">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>';
                }
            }
            
            unset($innerRow);
        }
        unset($row);
        unset($cc);

        return 0;

    }catch(PDOException $e){
        print "Error: " . $e->getMessage(); 
        return 0;
    }
}

function submitAssignment($CRN, $email, $name, $link){
    try{

        $db = connect();

        $stmnt = $db->prepare("CALL submitAssignment(:CRN, :email, :name, :link)");

        $stmnt->bindParam(":CRN", $CRN);

        $stmnt->bindParam(":name", $name);

        $stmnt->bindParam(":email", $email);

        $stmnt->bindParam(":link", $link);

        $stmnt->execute();

        return 1;

    }catch(PDOException $e){
        print "Error: " . $e->getMessage();
        return 0;
    }
}

function printGrading($email){
    try{
        $db = connect();

        $stmnt = $db->prepare("CALL getTeacherCRN(:email)");

        $stmnt->bindParam(":email", $email);

        $stmnt->execute();

        $crn = $stmnt->fetchAll();

        $stmnt->closeCursor();

        $stmnt = $db->prepare("CALL getCompleted(:CRN)");

        foreach($crn as &$class){
            $stmnt->bindParam(":CRN", $class['CRN']);

            $stmnt->execute();

            $completed = $stmnt->fetchAll();

            $stmnt->closeCursor();

            if(count($completed)){
                foreach($completed as &$grade){
                    if($grade['points'] == NULL){
                        echo '<li class="list-group-item">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">'. $grade['CRN'] . ': ' . $grade['name'] . '<br><a href="' . $grade['link'] . '">Link to Assignment</a>
                                    </div>
                                    <div class="widget-subheading">
                                        <form action="teacherMainPage.php" method="post">
                                            <input type="text" name="' . $grade['name'] . '">
                                            <button type="submit" name="gradeSubmit" value="CRN=' . $grade['CRN'] . '&name=' . $grade['name'] . '&email=' . $grade['email'] . '">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>';
                    }
                }
            }
        }



    }catch(PDOException $e){
        print "Error: " .  $e->getMessage();
        return 0;
    }
}

function addStudentClass($email, $CRN){
    try{
        $db = connect();

        $validCRN = $db->prepare("SELECT COUNT(*) FROM course where CRN = :CRN");

        $validCRN->bindParam(":CRN", $CRN);

        $validCRN->execute();

        $rs = $validCRN->fetchAll();

        $validCRN->closeCursor();
        
        if($rs[0]){

            $stmnt = $db->prepare("CALL addStudentClass(:CRN, :email)");

            $stmnt->bindParam(":CRN", $CRN);

            $stmnt->bindParam(":email", $email);

            $stmnt->execute();

            return 1;
        }

        return 0;

    }catch(PDOException $e){
        print "Error: " . $e->getMessage();
        return 0;
    }
}

function generateLeaderboard($email){

    try{
        $db = connect();

        $stmnt = $db->prepare("SELECT CRN FROM takes WHERE email = :email");

        $stmnt->bindParam(":email", $email);

        $stmnt->execute();

        $rs = $stmnt->fetchAll();

        $stmnt->closeCursor();

        $innerStmnt = $db->prepare("CALL generateLeaderboard(:CRN)");

        if(count($rs)){
            foreach($rs as &$class){
                $innerStmnt->bindparam(":CRN", $class['CRN']);
                $innerStmnt->execute();
                $innerRS = $innerStmnt->fetchAll();
                $innerStmnt->closeCursor();

                foreach($innerRS as &$rank){
                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">
                    ' . $rank['email'] .'
                    <span>' . $rank['points'] . '</span>
                </li>';
                }
            }
        }

    }catch(PDOException $e){
        print "Error: " . $e->getMessage();
        return 0;
    }
}
function gradeAssignment($CRN, $email, $points, $name){
    try{
        $db = connect();

        $stmnt = $db->prepare("CALL gradeAssignment(:CRN, :email, :points, :name)");

        $stmnt->bindParam(":CRN", $CRN);

        $stmnt->bindParam(":email", $email);

        $stmnt->bindParam(":points", $points);

        $stmnt->bindParam(":name", $name);

        $stmnt->execute();

        return 1;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage();
        return 0;
    }
}
?>