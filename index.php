<!DOCTYPE html>

<?php 	
	include 'dbconnection.php';		
?>

<html>
	<head>
		<title>Owner Login</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>
	</head>

	<body>
		<nav>
				<div class="navcontainer">
					<h1><a href="index.php">Pet Hospital</a></h1>
					<ul>
					<li><a href="docLogin.php">Doctor Login</a></li>
					</ul>
				</div>
		</nav>

		<div class="logincontainer">
			<h2>Owner Login</h2>
			<form action="ownerAccount.php" method="POST">
				<label for="username">Username:</label>
				<input type="text" name="username" id="username" required title="username"/>
				<br/>
				<label for="password">Password:</label>
				<input type="text" name="password" id="password" required title="password"/>
				<br/>
				<button type="submit">Submit</button>
				<br/>
				<br/>
				<a href="ownerForm.php">Create an Account</a>
				<br/>
				<a href="#">Forgot Username or Password</a>
			</form>
		</div>
		
	</body>
</html>