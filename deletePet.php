<!DOCTYPE html>

<?php 
	
	include 'dbconnection.php';			
?>

<html>
	<head>
		<title>Delete Pet</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>

	</head>

	<body>
		<?php
		include 'navigation.php';
	?>

		<div class="bodycontainer">
		<h2>A Pet has been deleted</h2>

		<h3>Refresh page to see pets remaining in the Database</h3>

		<?php
			$sql = "SELECT Name, Type, Age, ID  FROM pets";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			    		
			        echo $row['ID'] . $row['Name'] . " | " . $row['Type'] . " | " . $row['Age'] . "</br>" ;
   	
			    }//end of while loop
			}//end of if

			//
			$sql = "DELETE FROM pets where ID = $_GET[petID]";
			
			$result = $conn->query($sql);
		?>
		</div>
	</body>
</html>