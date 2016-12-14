<!DOCTYPE html>

<?php 
	//open the connection
	include 'dbconnection.php';
	//if there is info in the POST update the table
	if(isset($_POST))
	{
		//get all the info from the post array and store them in the database
		$petName = $_POST['petName'];
		$petType = $_POST['petType'];
		$petAge = $_POST['petAge'];
		$owner = $_POST['ownerName'];

		//Update the pet info except for the owner. how do I update the owner
		$sql = "UPDATE pets SET Age=" . $petAge . ", Name=" . $petName . ", Type=" . $petType . "where ID =" .  $_GET[petID];
			
		$result = $conn->query($sql);
		$conn->close();

	}

	if(isset($_GET))
	{
		//get all the info for the pet specified
		$sql = "SELECT Name, Type, Age, ID  FROM pets WHERE ID = $_GET[petID]";
		//store that info in this result
		$result = $conn->query($sql);
		//if there is a result, say so and put the values in the $row variable
		if ($result->num_rows > 0) {
			
			$row = $result->fetch_assoc();	    	
	   	
		}//end of if		
	}		
?>

<html>
	<head>
		<title>Update Pet</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>
	</head>

	<body>
		<?php
		include 'navigation.php';
	?>

		<div class="bodycontainer">

		<h2>Update a Pet</h2>
		<!--Prefill the form with the values from the $row-->
		<form action="updatePet.php" method="POST">
			<label for="petName">Pet Name:</label>
			<input type="text" name="petName" id="petName" <?php  echo "value='" . $row['Name'] . "'" ?> />
			<br/>
			<label for="petType">Pet Type:</label>
			<input type="text" name="petType" id="petType" <?php  echo "value='" . $row['Type'] . "'" ?>/>
			<br/>
			<label for="petAge">Pet Age:</label>
			<input type="text" name="petAge" id="petAge" <?php  echo "value='" . $row['Age'] . "'" ?>/>
			<br/>
			<label for="ownerName"> Owner Name:</label>
			<select name="ownerName" id="ownerName" value="testOwner">
			<?php
					//dynamically generate all the owner options in the drop down
					$sql = "SELECT ID, Name FROM owners";
					$result = $conn->query($sql);
					
					if($result->num_rows > 0)
					{
						//output data of each row
						while( $row = $result->fetch_assoc() )
						{
							echo "<option value='". $row["ID"]. "'>" . $row["Name"] . "</option>";
						}
					}//end of if	
				?>	
			</select>
			<br/>
			<button type="submit">Submit</button> <!-- Store updated values in the POST array-->

		</form>
		</div>
	</body>
</html>