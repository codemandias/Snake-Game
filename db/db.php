<!-- Connects the database -->

<?php
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