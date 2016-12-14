<!DOCTYPE html>



<html>
	
	<head>
		<title>Pet Detail</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>
	</head>

	<body>
		<nav>
			<?php
				include 'navigationLogout.php';
			?>
		</nav>

		<div class="bodycontainer">

			<h2>Pet Detail</h2>

			<?php
				include 'dbconnection.php';

				if(isset($_GET['petID']))
				{

					$petID = $_GET['petID'];
					echo "<p class='pets'><b>PetID: </b>" . $petID . "</p>";

					$sql = "SELECT owners.Name as ownerName, pets.Name as petName, pets.ID, pets.Age as petAge,
								 Type, Medical_History, Symptoms, Next_Appt, Notes 
									FROM owners JOIN pets ON pets.Owner_ID = owners.ID WHERE pets.ID = '$petID'";

					$result = $conn->query($sql);

					if ($result->num_rows > 0)
					{
						// output data of each row
						while($row = $result->fetch_assoc()) 
						{
							    	
							echo "<p class='pets'><b>Owner Name: </b>" . $row['ownerName'] . " <br/> <b>Pet Name:  </b>" . $row['petName']
									 ." <br/> <b>Type: </b>" . $row['Type'] . " <br/><b>Pet Age: </b>" . $row['petAge'] . " <br/><b> Current Symptoms: </b>" .
								   		 $row['Symptoms'] . "<br/> Medical_History: " . $row['Medical_History'] . " <br/> Next_Appt: " . $row['Next_Appt'] ;
						}
					}
				}		
			?>
			
			<h2> Add an Appt</h2>
			<form action="addAppt.php" method="POST" id="addAppt">
				<label for="appt">Appt Date and Time</label>
				<input type="text" name="appt" id="appt" />
				<input type="hidden" name="petID" id="petID" <?php if(isset($petID)) echo "value='" . $petID . "'" ?>/>
				<br/>
				<button type="submit">Submit</button>
			</form>
		</div>
			
	</body>

</html>