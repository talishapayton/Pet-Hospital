<!DOCTYPE html>

<html>
	
	<head>
		<title>Owner Registration</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>

	</head>

	<body>
		<?php
			include 'navigation.php';
		?>

		<div class="bodycontainer">
		<h2>Create an Account</h2>
		<form action="addOwner.php" method="POST">
			<label for="name">Name:</label>
			<input type="text" name="name" id="name" required  pattern="[A-Za-z-0-9]+\s[A-Za-z-'0-9]+" title="firstname lastname"/>
			<br/>
			<label for="name">Create a Username:</label>
			<input type="text" name="username" id="username" required title="username"/>
			<br/>
			<label for="name">Create a Password</label>
			<input type="text" name="password" id="password" required title="password"/>
			<br/>
			
			<button type="submit">Submit</button>

		</form>
		</div>
	</body>

</html>