<!-- 
    Feature: Displays the leader board for the game 
    Implementor: Aks Chunara (B00843788)
-->
<div id="high_scores">
    <h3>Leaderboard</h3>
    <div class="table-responsive">
        <?php
            require_once("./db/db.php");
            $querySQL = "SELECT `id`, `username`, `high_score` FROM `user-details` ORDER BY `high_score` DESC";
            $result = $dbconnection->query($querySQL);

            if ($result->num_rows > 0) {
                //6. The border-color was referenced from the code from the Bootstrap "Border Color" example 
                //   available at: https://getbootstrap.com/docs/5.0/utilities/borders/#border-color (accessed 26 Feb 2021) 
                //   (Created by: Mark Otto, Jacob Thornton, and Bootstrap contributors) 
                //   The "Border Color" example is (c) Bootstrap, and is free for reference and customization
                
                //7. The tables was referenced from the code from the Bootstrap "Tables" example 
                //   available at: https://getbootstrap.com/docs/5.0/content/tables/ (accessed 26 Feb 2021) 
                //   (Created by: Mark Otto, Jacob Thornton, and Bootstrap contributors) 
                //   The "Tables" example is (c) Bootstrap, and is free for reference and customization
                echo "<table class='table table-bordered table-dark border-dark'>
                        <thead>
                            <tr>
                                <th scope='col'>Rank</th>
                                <th scope='col'>Username</th>
                                <th scope='col'>High Score</th>
                            </tr>
                        </thead>";
                $rank = 1;
                while ($row = $result->fetch_assoc()) {
                    $userID = $row['id'];
                    $username = $row['username'];
                    $highscore = $row['high_score'];

                    if($_SESSION['userID'] == $userID){
                        echo "<tr class='table-secondary' id='userScore'>
                                <td scope='col'>$rank</th>
                                <td scope='col'>$username</th>
                                <td scope='col'>$highscore</th>
                            </tr>";
                    } else{
                        echo "<tr class='table-light'>
                                <td scope='col'>$rank</td>
                                <td scope='col'>$username</td>
                                <td scope='col'>$highscore</td>
                            </tr>";
                    }
                    $rank++;
                }
                echo "</table>";
            } else {
                echo "<p>You are the first to play this game.</p>";
            }
        ?>
    </div>
</div>