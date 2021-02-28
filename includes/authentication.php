<!-- 
    Authenticates the user
    Implementor: Aks Chunara
-->

<?php
    //Start Sessions
    session_start();
    require_once("../db/db.php");

    $authenticated = false;
    $location = "Location: ../index.php?";
    
    // $_SESSION['userID'] = 'a';
    // header('$location');

    //Checks whether the username and password is entered
    $error = "";
    if(!isset($_POST['username'])){
        $error .="userError=1";
    }
    if(!isset($_POST['password'])){
        $error .="&passError=1";
    }
    //Redirects with error message if not entered
    if($error != ""){
        header($location.$error);
    }

    //Checks whether user want to sign up or log in
    if (isset($_POST['login']) || isset($_POST['signup'])) {
        $username = trim(stripslashes(htmlspecialchars($_POST['username'])));
        $password = trim(stripslashes(htmlspecialchars($_POST['password'])));
        $password = hash('sha256', $password);

        $querySQL = "SELECT `id` FROM `user-credentials` WHERE `username` = '$username'";
        if (isset($_POST['signup'])) { 
            //Signs up the user
            $result = $dbconnection->query($querySQL);
            if($result->num_rows == 0){
                $querySQL = "INSERT INTO `user-credentials` (`username`, `password`) VALUES ('$username', '$password');";
                $result = $dbconnection->query($querySQL);
                if($result){
                    $querySQL = "INSERT INTO `user-details` (`username`) VALUES ('$username');";
                    $result = $dbconnection->query($querySQL);
                    if($result){
                        $authenticated = true;
                    } else{
                        //drop user
                    }
                } else {
                    //Redirects with error message if user could not be registered
                    header("$location loginerror=1");
                }
            } else {
                //Redirects with error message if username already exists
                header("$location loginerror=2");
            }
        } else if (isset($_POST['login'])){
            //Logs in the user
            $querySQL .= " and `password` = '$password';";
            $result = $dbconnection->query($querySQL);
            if ($result->num_rows == 1) {
                $authenticated = true;
            } else {
                //Redirects with error message 
                header("$location loginerror=3");
            }
        }
        //Checks whether the signup or login was successful
        if($authenticated){
            session_regenerate_id(false);
            // $querySQL = "SELECT BINARY_CHECKSUM(`id`) as `ID` FROM `user-details` WHERE `username` = '$username'";
            $querySQL = "SELECT `id` FROM `user-credentials` WHERE `username` = '$username'";
            $result = $dbconnection->query($querySQL);
            if($result->num_rows == 1){
                $result = $result->fetch_assoc();
                $_SESSION['userID'] = $result['id'];
            } else {
                header("$location loginerror=3");
            }
        }
    }
    header($location);
?>