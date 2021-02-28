<?php
    // Feature: Implement Game Board/Boundary
    // Implemented By: Aditya Sharma (B00827775)
    // Learned: How to effectively output a matrix of rows and columnns by sending it through sever side
    //			using php with valid id names/numbers. 

    echo "<table style='border-collapse: collapse;'>";
    for($i=0;$i<30;$i++){
        echo "<tr id='$i' class='rows'>";
        for ($j = 0; $j < 30; $j++) {
            echo "<td id='$i - $j' class='columns'></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
?>