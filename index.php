<?php
/*
 * CSCI 2170: ONLINE EDITION, WINTER 2021
 * STARTER CODE FOR ASSIGNMENT 2
 * 
 * This code was customized by using the code from the Bootstrap "Album" example available at:
 * https://getbootstrap.com/docs/5.0/examples/album/ (accessed 11 Jan 2021)
 * (Created by: Mark Otto, Jacob Thornton, and Bootstrap contributors)
 * The Album example is (c) Bootstrap, and is free to download and customize.
 *
 */

	//Header
	require "includes/header.php"; 
	//Connects Database
	require_once "./db/db.php";
?>
<main id="pg-main-content">
    <section class="space-above-below">
        <?php
            require "includes/login.php";
        ?>
    </section>
</main>

<?php 
	//Footer
	require "includes/footer.php"; 
?>