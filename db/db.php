<!-- Connects the database -->

<?php
	// $hostservername = "db.cs.dal.ca";
	// $username = "chunara";
	// $password = "2amR2aiY8STtTxJKbkGKvofho";
	// $dbname = "chunara";
	
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