<!DOCTYPE html>

<html>
	
	<head>
		<title>Check Owner Login</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>

	</head>

	<body>


		<?php
		include 'navigation.php';
		?>
		<div class="bodycontainer">

		<div class="leftSide">

		<?php 		
			include 'dbconnection.php';

			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);

			$sql = "SELECT * FROM owners WHERE Username = '$username' AND Password = '$password'";

			$result = $conn->query($sql);

			$ownersRow;
			$nextAppt;


			if ($result->num_rows > 0) 
			{
				echo "WELCOME, ";
				// output data of each row
				$rowArray = $result->fetch_assoc();
				
				//output the name from the row
				echo $rowArray['Name'] . "<br/>"; 	

				$ownersRow = $rowArray;	
			}
			else 
			{
				echo "Username and password combination not found";
			}

			//get the owners ID from the array. 
			$ownerID = $ownersRow['ID'];
			
			//Check to see if the owners ID matches any of the Owner IDs in the pets table.
			$sql = "SELECT * from pets WHERE Owner_ID = '$ownerID'";

			//store the result of the sql query 
			$petResult = $conn->query($sql);

			//If the owner has pets, print out their pets info
			if($petResult->num_rows >0)
			{

				//put the query results into an Array for you to easily grab their contents.
				 while($petRowArray = $petResult->fetch_assoc())
				 {
				 	$appt = $petRowArray['Next_Appt'];
				 	$nextAppt = "No appts Scheduled";

				 	if(isset($appt))
				 	{
				 		$nextAppt = $appt;
				 	}

					//print out the contents of the pet Array
					echo "<div class='aPet'><p class='left'><b> Name: </b>" . $petRowArray['Name'] . "<br/><b>Age: </b>" . $petRowArray['Age'] .
					 "<br/><b>Type: </b>" . $petRowArray['Type'] ."</p><p class='docNotes'><b>Doctors Notes: </b>" .  $petRowArray['Notes'] . 
					  "<br/><b>Next Appt: </b>" . $nextAppt . "</p></div>" ;

				}
			}
			else //otherwise ask them to enter pets
			{
				echo "Please add some pets to the system";
			}
		?>
		</div>
		
			<div class="middle">
				<h2>Add a New Pet</h2>
				<form action="addPet.php" method="POST" id="addPet">
					<label for="petName">* Pet Name:</label>
					<input type="text" name="petName" id="petName" <?php  if(isset($pet['Name'] ))echo "value='" . $pet['Name'] . "'" ?> required pattern="[a-zA-Z]+" title="letters only"/>
					<br/>
					<br/>
					<label for="petType">* Pet Type:</label>
					<input type="text" name="petType" id="petType" <?php  if(isset($pet['Type'] )) echo "value='" . $pet['Type'] . "'" ?> required pattern="[a-zA-Z]+" title="letters only"/>
					<br/>
					<br/>
					<label for="petAge">* Pet Age:</label>
					<input type="text" name="petAge" id="petAge"<?php  if(isset($pet['Age'] )) echo "value='" . $pet['Age'] . "'" ?> required pattern="[0-9]?[0-9]" title="number between 0-99"/>
					<br/>
					<br/>
					<label for="symptoms">Current Symptoms:</label>
					<textarea form="addPet" name="symptoms" id="symptoms"></textarea>
					<br/>
					<br/>
					<input type="hidden" name="ownerID" id="ownerID" <?php if(isset($ownerID)) echo "value='" . $ownerID . "'" ?>/>		
					<br/>
					<button type="submit">Submit</button>
				</form>
			</div>


			<!-- <div class="rightSide">
				<h2>Upcoming Appts</h2>
				<p><?php if(isset($nextAppt)) echo  $nextAppt  ?></p>
			</div> -->

		</div>
			
	</body>

</html>