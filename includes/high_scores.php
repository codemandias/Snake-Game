<!-- 
    Displays the leader board for the game 
    Implementor: Aks Chunara
-->
<h2>Leaderboard</h2>
<?php
    require_once("./db/db.php");
    $querySQL = "SELECT `username`, `high_score` FROM `user-details` ORDER BY `high_score` DESC";
    $result = $dbconnection->query($querySQL);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>High Score</th>
                </tr>";
        $rank = 1;
        while ($row = $result->fetch_assoc()) {
            $username = $row['username'];
            $highscore = $row['high_score'];
            echo "<tr>
                    <td>$rank</td>
                    <td>$username</td>
                    <td>$highscore</td>
                  </tr>";
            $rank++;
        }
        echo "</table>";
    } else {
        echo "<p>You are the first to play this game.</p>";
    }
?>