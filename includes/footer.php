		<footer id="pg-footer" class="text-muted py-5">
			<div class="container">
				<p class="mb-1">&copy; 2021 Snake Game</p>
			</div>
		</footer>

		<?php
			if(isset($dbconnection)){
				$dbconnection -> close();
			}
		?>

		<!-- Bootstrap core JS -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	  
	</body>
</html>
