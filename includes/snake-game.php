<?php 
    echo "<body ";
    if(isset($_GET['gamestart'])){
        echo "onload='init()'>";
    } else {
        echo ">";
    }
?>
    <h3>Snake Game</h3>
    <div id="boundary">
        <!-- 
            Feature: Displays the current score of the player
            Implemented By: Aditya Sharma (B00827775)
        -->
        <h3 id="score">0</h3>
        <div class='board'>
        <!-- 
            Feature: Displays the gameover and intro screen and synchs score with database 
            Implementor: Aks Chunara
        -->
        <?php
            //Checks if game is not over and has started
            if(!isset($_GET['gameover']) && isset($_GET['gamestart'])){
                require "./includes/game_boundry.php";
            } else {
                echo "<div id='screen' class='columns'>
                            <div>";
                            if(isset($_GET['gameover'])){
                                //Displays gameover screen
                                echo "<h3>Game Over!<br/>
                                Better Luck Next Time<br/><br/></h3>
                                <a href='./index.php?gamestart=1'><h4>Try Again</h4></a>";

                                //Synchs highscore with database
                                $curr_score = $_GET['finalScore'];
                                $querySQL = "SELECT `high_score` FROM `user-details`
                                            WHERE `id` = " . $_SESSION['userID'];
                                $result = $dbconnection->query($querySQL);
                                if ($result->num_rows > 0 && $result->fetch_assoc()['high_score'] < $curr_score){ 
                                    $querySQL = "UPDATE `user-details` SET `high_score` = ('$curr_score') 
                                                WHERE `id` = " . $_SESSION['userID'].";";
                                    $result = $dbconnection->query($querySQL);
                                }
                            } else {
                                //Displays intro screen
                                echo "<h3>Welcome To<br/>
                                The Snake Game<br/><br/></h3>
                                <a href='./index.php?gamestart=1'><h4>Start Game</h4></a>";
                            }
                echo        "</div>
                    </div>";
            }
        ?>
        </div>
    </div>
</body>