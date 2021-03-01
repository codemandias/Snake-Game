<!-- 
    Authenticates the user
    Implementor: Aks Chunara (B00843788)
-->

<?php
    //Start Sessions
    session_start();
    require_once("../db/db.php");

    $authenticated = false;
    $location = "Location: ../index.php?";

    //Checks whether the username and password is entered
    $error = "";
    if($_POST['username'] == ""){
        $error .="userError=1";
    }
    if($_POST['password'] == ""){
        $error .="&passError=1";
    }
    
    //Redirects with error message if not entered
    if($error != ""){
        header($location.$error);
    } else{
        //Checks whether user want to sign up or log in
        if (isset($_POST['login']) || isset($_POST['signup'])) {
            $username = trim(stripslashes(htmlspecialchars($_POST['username'])));
            $password = trim(stripslashes(htmlspecialchars($_POST['password'])));

            //3. The hash function from php was referenced from the code from PHP website "hash" example
            // available at: https://www.php.net/manual/en/function.hash.php (accessed 26 Feb 2021)
             // The "hash" example is (c) PHP Group, and is free for reference
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
                //The session-regenerate-id function from php was referenced from the code from PHP website "session-regenerate-id" example
                // available at: https://www.php.net/manual/en/function.session-regenerate-id.php (accessed 26 Feb 2021)
                // The "session-regenerate-id" example is (c) PHP Group, and is free for reference
                session_regenerate_id(false);
                
                $querySQL = "SELECT `id` FROM `user-credentials` WHERE `username` = '$username'";
                $result = $dbconnection->query($querySQL);
                if($result->num_rows == 1){
                    $result = $result->fetch_assoc();
                    $_SESSION['userID'] = $result['id'];
                    header($location);
                } else {
                    header("$location loginerror=3");
                }
            }
        }
    }
?>