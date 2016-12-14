<!DOCTYPE html>

<?php 	
	include 'dbconnection.php';		
?>

<html>
	<head>
		<title>Doctor Login</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>
	</head>

	<body>
		<?php
			include 'navigation.php';
		?>

		<div class="bodycontainer">
			<h2>DOCTOR Login</h2>
			<form action="docAccount.php" method="POST">
				<label for="username">Username:</label>
				<input type="text" name="username" id="username" required title="username"/>
				<br/>
				<label for="password">Password:</label>
				<input type="text" name="password" id="password" required title="password"/>
				<br/>
				<a href="#">Forgot Username or Password</a>
				<br/>
				<button type="submit">Submit</button>
			</form>
		</div>
		
	</body>
</html>