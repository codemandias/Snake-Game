<!-- Connects the database -->

<?php
	// Server host details for my website
	// Same username and password can be used to play the game
	// $hostservername = "db.cs.dal.ca";
	// $username = "aditya";
	// $password = "XdEZbZP99WtgrBVUE35A5C4dx";
	// $dbname = "aditya";
	
	$hostservername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "GroupAssignmentDB";

	$dbconnection = new mysqli($hostservername, $username, $password, $dbname);

	//Checks if there is a connection error
	if ($dbconnection->connect_error) {
		die("Sorry, There was an error connecting to the database.");
	}
?>