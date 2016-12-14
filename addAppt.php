<!DOCTYPE html>

<?php 
			
	include 'dbconnection.php';

	$appt = mysqli_real_escape_string($conn, $_POST['appt']);

	if(isset($_POST['petID']))
	{
		$petID = $_POST['petID'];
		echo "PetID" . $petID;
		echo "Appt" . $appt;

		$sql = "UPDATE pets SET Next_Appt='$appt' WHERE ID = $petID";
		$result = $conn->query($sql);
		echo "appt was added!";

	}
	

?>

<html>
	
	<head>
		<title>Appt Added</title>
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