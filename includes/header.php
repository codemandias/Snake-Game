<!doctype html>
<html lang="en">
  	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Snake</title>
	
		<!-- Bootstrap core CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">	

		<!-- Custom CSS and JavaScript -->
		<link type="text/css" rel="stylesheet" href="css/main.css">
    	<script type="text/javascript" src="js/script.js"></script>
  	</head>
  	<body>
		<header id="pg-header">
			<nav class="navbar navbar-expand navbar-dark bg-dark">
				<div class="container-fluid">
					<div class="collapse navbar-collapse">

						<ul class="navbar-nav me-auto">
							<li class="nav-item active" id="home">
								<a class="nav-link" aria-current="page" href="index.php">Home</a>
							</li>
							<li class="nav-item active" id="logout">
								<a class="nav-link" aria-current="page" href="./includes/logout.php">Log Out</a>
							</li>
						</ul>

					</div>
				</div>
			</nav>

			<?php
				//Start Session
				session_start();
			?>
		</header>
