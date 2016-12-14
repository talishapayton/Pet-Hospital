<!DOCTYPE html>
<?php 
			
	include 'dbconnection.php';
			
	$sql = "SELECT ID, Name FROM owners";

	$owners = $conn->query($sql);

	if(isset($_GET['petID']))
	{
		$petID = $_GET['petID'];

		//get all the info for the pet specified
		$sql = "SELECT * FROM pets WHERE ID = $petID";
		//store that info in this result
		$result = $conn->query($sql);
		//if there is a result, say so and put the values in the $row variable
		if ($result->num_rows > 0) 
		{	
			$pet = $result->fetch_assoc();    	
		}		
	}				
?>

<html>
	<head>
		<title>Update a Pet</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>
	</head>

	<body>
	<?php
		include 'navigation.php';
	?>

		<div class="bodycontainer">

		<h2>Update a Pet</h2>
		<form action="addPet.php" method="POST" id="updatePet">
		<?php if(isset($petID)) echo "<input type='hidden' name='petID' value=" . $petID ." >"; ?>
			<label for="petName">* Pet Name:</label>
			<input type="text" name="petName" id="petName" <?php  if(isset($pet['Name'] ))echo "value='" . $pet['Name'] . "'" ?> required pattern="[a-zA-Z]+" title="letters only"/>
			<br/>
			<label for="petType">* Pet Type:</label>
			<input type="text" name="petType" id="petType" <?php  if(isset($pet['Type'] )) echo "value='" . $pet['Type'] . "'" ?> required pattern="[a-zA-Z]+" title="letters only"/>
			<br/>
			<label for="petAge">* Pet Age:</label>
			<input type="text" name="petAge" id="petAge"<?php  if(isset($pet['Age'] )) echo "value='" . $pet['Age'] . "'" ?> required pattern="[0-9]?[0-9]" title="number between 0-99"/>
			<br/>
			<label for="symptoms">Current Symptoms:</label>
			<textarea form="updatePet" name="symptoms" id="symptoms"></textarea>
			<br/>
			<label for="history">Medical History:</label>
			<textarea form="updatePet" name="history" id="history"></textarea>
			<br/>
			<label for="notes">Notes for Owner:</label>
			<textarea form="updatePet" name="notes" id="notes"><?php  if(isset($pet['Notes'] )) echo  $pet['Notes'] ?></textarea>
			<br/>
			<input type="hidden" name="ownerID" id="ownerID" <?php if(isset($pet['Owner_ID'])) echo "value='" . $pet['Owner_ID'] . "'" ?>/>			
			<br/>
			<label for="ownerName">* Owner Name: </label>
			<select name="ownerName" id="ownerName" required>
				<?php
                if ($owners->num_rows > 0) {
                    // output data of each row
                    while($row = $owners->fetch_assoc()) {
                        echo "<option value='" . $row["ID"] ."'";
                        if (isset($pet) and  $pet['Owner_ID'] == $row["ID"]) echo "selected";
                        echo ">" . $row["Name"] . "</option>";
                    }
                }
                ?>
			</select>
			<br/>
			<button type="submit">Submit</button>

		</form>
		</div>
	</body>

</html>