<?php
	$servername ="localhost";
	$username = "root";
	$password ="";
	$dbname = "idd-632";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
		//echo "Successfully Connected to the database";
?>