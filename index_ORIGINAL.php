<!DOCTYPE html>

<?php 	
	include 'dbconnection.php';
			
	$sql = "SELECT owners.Name as ownerName, owners.Age as ownerAge,
					pets.Name as petName, Type, pets.ID, pets.Age as petAge
			FROM owners JOIN pets ON pets.Owner_ID = owners.ID";
	$result = $conn->query($sql);
?>

<html>
	<head>
		<title>Add a Pet or Owner</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>
	</head>

	<body>
	<?php
		include 'navigation.php';
	?>
		

		<div class="bodycontainer">
		<h2> Pet Hospital Database</h2>
		<p>Select a pet below to update their file</p>

		<?php
			if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			    	
			    	//create a table that shows owners and their pets
			        echo "<p class='pets'>" . $row['ownerName'] . " | " . $row['ownerAge'] . " | " . $row['petName'] ." | " . $row['Type'] . " | " . $row['petAge'] . " | " .

			        		"<a href=deletePet.php?petID=" . $row['ID']. ">delete</a>" .
			        		 " | <a href=pet-form.php?petID=" . $row['ID']. "> UPDATE </a>" ."</p>";
			    }
			}
		?>
		</div>
	</body>
</html>