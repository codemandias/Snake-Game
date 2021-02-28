<!-- 
    Displays the leader board for the game 
    Implementor: Aks Chunara
-->
<h2>Leaderboard</h2>
<?php
    require_once("./db/db.php");
    $querySQL = "SELECT `id`, `username`, `high_score` FROM `user-details` ORDER BY `high_score` DESC";
    $result = $dbconnection->query($querySQL);

    if ($result->num_rows > 0) {
        echo "<table class='table table-dark'>
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
                echo "<thead class="thead-light">
                        <tr>
                        <th scope="col">$rank</th>
                        <th scope="col">$username</th>
                        <th scope="col">$highscore</th>
                        </tr>
                    </thead>";
            } else{
                echo "<tr>
                        <th scope="row">$rank</td>
                        <td>$username</td>
                        <td>$highscore</td>
                    </tr>";
            }
            $rank++;
        }
        echo "</table>";
    } else {
        echo "<p>You are the first to play this game.</p>";
    }
?>