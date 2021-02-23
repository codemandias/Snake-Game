<!DOCTYPE html>
<html lang="en">
<head>
    <title>Group Assignment 1</title>
    <link type="text/css" rel="stylesheet" href="css/main.css">
    <script type="text/javascript" src="js/script.js"></script>
</head>
<body onload="init()">
<h3>Snake Game</h3>
<div id="boundary">
<h3 id="over"></h3>
<div class='board'>

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

</div>
</div>
</body>
</html>