<?php


# CONNECTION - connects to the DB using the proper user
# return - The instance of the database
function connect(){
    $dbh = new PDO("mysq:host=47.6.28.163;dbname=CS3141", "3141", "1234");
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

        # If the username and password is in the database it will return 1
        $stmnt = $db->prepare("SELECT COUNT(*) FROM USER WHERE USERNAME = :user and PASSWD = :passwd");

        # Set the variables 
        $stmnt->bindParam(":user", $user);
        $stmnt->bindParam(":passwd", $passwd);
        
        # Execute the statement
        $stmnt->execute();

        # Resultet -> $rs. This is an array of the return values
        $rs = $stmnt->fetch();

        # The result set for this query is going to return an array [x] where x is the number of times that username and password combo is in the database
        
        # If the number is 1 we know the user is valid, if it is 0 then the user is not valid.
        return $rs[0];
        

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
        $stmnt = $db->prepare("SELECT COUNT(USERNAME) FROM USER WHERE USERNAME = :user");

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
        $stmnt = $db->prepare("INSERT INTO USER VALUES (:user, :passwd)");

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

?>