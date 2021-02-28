<!-- 
    The login form
    Implementor: Aks Chunara
-->

<?php
    if(!isset($_SESSION['userID'])){
?>
    <section class='container' id="Login">
        <h1>Login</h1>
        <form action = "./includes/authentication.php" method="post">
            <!-- Username -->
            <div class='row'>
                <div class='col'>
                    <label for="username">Username:</label>
                    <input id="username" type="text" name="username">
                    <?php
                        if(isset($_GET['userError'])){
                            $errorNo = $_GET['userError'];
                            if($errorNo == 1){
                                $errorMsg = "Please enter a valid username";
                            }
                            echo "<p id = 'missingUsernameError' style = 'color:red;'> $errorMsg </p>";
                        }
                    ?>
                </div>
            </div>

            <!-- Password -->
            <div class='row'>
                <div class='col'>
                    <label for="password">Password:</label>
                    <input id="password" type="password" name="password">
                    <?php
                        if(isset($_GET['passError'])){
                            $errorNo = $_GET['passError'];
                            if($errorNo == 1){
                                $errorMsg = "Please enter a valid password";
                            }
                            echo "<p id = 'missingPasswordError' style = 'color:red;'> $errorMsg </p>";
                        }
                    ?>
                </div>
            </div>

            <!-- Log In / Sign Up Button -->
            <div class='row'>
                <div class='col'>
                    <button type="input" name="login">Log In</button>
                    <button type="input" name="signup">Sign Up</button>
                </div>
                <?php
                    if(isset($_GET['loginerror'])){
                        $errorNo = $_GET['loginerror'];
                        if($errorNo == 1){
                            $errorMsg = "Registration failed, please try again";
                        } else if($errorNo == 2){
                            $errorMsg = "Username already exists, please try using another one";
                        } else if($errorNo == 3){
                            $errorMsg = "The Username or Password entered is wrong";
                        }
                        echo "<p id = 'loginError' style = 'color:red;'> $errorMsg </p>";
                    }
                ?>
            </div>
        </form>
    </section>
<?php
    }
    else {
        require "./includes/game.php";
    }
?>