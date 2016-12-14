<!DOCTYPE html>



<html>
	
	<head>
		<title>Pet Detail</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>
	</head>

	<body>
		<nav>
			<div class="navcontainer">
				<h1><a href="index.php">Pet Hospital</a></h1>
				<ul>
					<li><a href="index.php">Logout</a></li>
				</ul>			
			</div>
		</nav>

		<div class="bodycontainer">

			<h2>Pet Detail</h2>

			<?php
				include 'dbconnection.php';

				if(isset($_GET['petID']))
				{

					$petID = $_GET['petID'];
					echo "PetID: " . $petID;

					$sql = "SELECT owners.Name as ownerName, pets.Name as petName, pets.ID, pets.Age as petAge,
								 Type, Medical_History, Symptoms, Next_Appt, Notes 
									FROM owners JOIN pets ON pets.Owner_ID = owners.ID WHERE pets.ID = '$petID'";

					$result = $conn->query($sql);

					if ($result->num_rows > 0)
					{
						// output data of each row
						while($row = $result->fetch_assoc()) 
						{
							    	
							//create a table that shows owners and their pets
							echo "<p class='pets'> Owner Name: " . $row['ownerName'] . " <br/> Pet Name:  " . $row['petName'] ." <br/> Type: " . $row['Type'] . " <br/>Pet Age: " . $row['petAge'] . " <br/> Current Symptoms: " .
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