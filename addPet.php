<!DOCTYPE html>

<?php 
			
	include 'dbconnection.php';

	$petName = mysqli_real_escape_string($conn, $_POST['petName']);
	$petType = mysqli_real_escape_string($conn, $_POST['petType']);
	$petAge = mysqli_real_escape_string($conn, $_POST['petAge']);

	$notes;
	if(isset($_POST['notes']))
	{
		$notes = mysqli_real_escape_string($conn, $_POST['notes']);
	}

	$history;
	if(isset($_POST['history']))
	{
		$history = mysqli_real_escape_string($conn, $_POST['history']);
	}

	$symptoms;
	if(isset($_POST['symptoms']))
	{
		$symptoms = mysqli_real_escape_string($conn, $_POST['symptoms']);
	}
	
	$ownerID;
	if(isset($_POST['ownerID']))
	{
		$ownerID = (int)$_POST['ownerID'];
		echo "Owner ID:" . $ownerID . "<br/>";
	}

	$newOwnerID;
	if(isset($_POST['ownerName']))
	{
		$newOwnerID = (int)$_POST['ownerName'];
		echo "New Owners ID yay:" . $newOwnerID . "<br/>";
	}

	//Check if a petID was provided if so, we're updating a pet, otherwise we're inserting
	if (isset($_POST['petID']))
	{
		echo "PetName: " . $petName . "<br/>";
		echo "PetType: " . $petType . "<br/>";
		echo "PetAge: " . $petAge . "<br/>";
		echo "Notes:  " . $notes . "<br/>";
		echo "History: " . $history . "<br/>";
		echo "Symtoms: " . $symptoms . "<br/>";

		//Check to see if history and notes are null. 

		$petID = $_POST['petID'];
		//Update the pet info except for the owner. 
		$sql = "UPDATE pets SET Name='$petName', Type='$petType', Age='$petAge', Owner_ID='$newOwnerID', Notes='$notes' WHERE ID='$petID'";
		
		if ($conn->query($sql) === TRUE)
		{
			echo "Record Updated";

		} else {
				 echo "Error: " . $sql . "<br>" . $conn->error;
		}

		//Concatenate symptoms, dont erase old ones. 
		$sql2 = "UPDATE pets set Symptoms = concat(Symptoms, '\n$symptoms') WHERE ID='$petID'" ;

		if ($conn->query($sql2) === TRUE)
		{
			echo "Symptoms appended";

		} else {
				 echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$sql3 = "UPDATE pets set Medical_History = concat(Medical_History, '\n$history') WHERE ID='$petID'" ;

		if ($conn->query($sql3) === TRUE)
		{
			echo "History appended";

		} else {
				 echo "Error: " . $sql . "<br>" . $conn->error;
		}


	}
	else
	{

		$sql = "INSERT INTO pets (Name, Type, Age, Symptoms, Owner_ID, Notes, Medical_History)
		VALUES ('$petName', '$petType', '$petAge', '$symptoms', '$ownerID', '', '')";

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";

			//header( 'Refresh: 3; URL= ownerAccount.php' );
		} else {
				 echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
?>

<html>
	
	<head>
		<title>Pet Added</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>

	</head>

	<body>
		<?php
			include 'navigation.php';
		?>

		<div class="bodycontainer">
			<h3> Pet has been added successfully!</h3>
			<p>Press back button to return, to your account page</p>
		</div>
	</body>

</html>