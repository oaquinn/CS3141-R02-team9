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

?>