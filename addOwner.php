<!DOCTYPE html>

<?php 
			
	include 'dbconnection.php';

	$ownerName = mysqli_real_escape_string($conn, $_POST['name']);
	$ownerUsername = mysqli_real_escape_string($conn, $_POST['username']);
	$ownerPassword = mysqli_real_escape_string($conn, $_POST['password']);
	
	$sql = "INSERT INTO owners (Name, Username, Password)
	VALUES ('$ownerName', '$ownerUsername', '$ownerPassword')";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
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
		</div>
	</body>

</html>