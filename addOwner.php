<!DOCTYPE html>

<?php 
			
	include 'dbconnection.php';

	$ownerName = mysqli_real_escape_string($conn, $_POST['name']);
	$ownerUsername = mysqli_real_escape_string($conn, $_POST['username']);
	$ownerPassword = mysqli_real_escape_string($conn, $_POST['password']);
	
	$sql = "INSERT INTO owners (Name, Username, Password)
	VALUES ('$ownerName', '$ownerUsername', '$ownerPassword')";

	if ($conn->query($sql) === TRUE) {
		
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

?>

<html>
	
	<head>
		<title>Owner Added</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>
	</head>

	<body>
		<?php
			include 'navigation.php';
		?>

		<div class="bodycontainer">
			<h3>Thanks for creating an account</h3>
			<p>Please login with your new username and password on the homepage.</p>
			<a href="index.php">Back to Home</a>
		</div>
	</body>

</html>