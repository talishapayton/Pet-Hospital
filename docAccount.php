<!DOCTYPE html>

<html>
	
	<head>
		<title>Doc Account</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>
	</head>

	<body>
		<?php
			include 'navigationLogout.php';
		?>

		<?php

			include 'dbconnection.php';

			//are we logged in?
			if( isset($_COOKIE['docUsername']) && isset($_COOKIE['docPassword']) )
			{
				$docUsername = $_COOKIE['docUsername'];
				$docPassword = $_COOKIE['docPassword'];
			}
			else //if not logged in check to see if username and password are valid 
			{
				if(isset($_POST['username']) && isset($_POST['password']))
				{
					$docUsername = mysqli_real_escape_string($conn, $_POST['username']);
					$docPassword = mysqli_real_escape_string($conn, $_POST['password']);

					$sql = "SELECT * FROM doctors WHERE Username = '$docUsername' AND Password = '$docPassword'";

					$result = $conn->query($sql);

					//If username and password are valid, set the cookie
					if ($result->num_rows > 0) 
					{
						echo "<h3>Hey DOC, welcome back to work </h3>";

						setCookie('docUsername', $docUsername, time() + 60, "/"); //logged in for 60 seconds
						setCookie('docPassword', $docPassword, time() + 60, "/"); //logged in for 60 seconds
						$loggedIn = true;
					}
					else //otherwise redirect them back to the homepage
					{
						echo "Username and password combination not found";
						header( 'Location: docLogin.php' );
					}
				}
				else
				{ //If you get to this page but are not logged in redirect back to homepage
					echo "You have been logged out. Return to login page.";
					header( 'Refresh: 1; URL= docLogin.php' );
				}		
			}		
		?>

		<div class="bodycontainer">

			<h2>Pet Search</h2>
			<form action="docAccount.php" method="POST">
				<label for="search">Search:</label>
				<input type="text" name="search" id="search" required title="search" value=" by petID, Owner Name or Pet Name"/>
				<button type="submit">Submit</button>
			</form>

			<h2> Pet Hospital Database</h2>
			<p>Select a pet below to update their file</p>
			

				<?php
						//If there has been search query filter the results
						if(isset($_POST['search']))
						{
							$searchTerm = mysqli_real_escape_string($conn, $_POST['search']);

							$searchQuery = "SELECT owners.Name as ownerName, pets.Name as petName, Type, pets.ID, pets.Age as petAge
											FROM owners JOIN pets ON pets.Owner_ID = owners.ID 
												WHERE pets.Name = '$searchTerm' 
													OR owners.Name = '$searchTerm' 
														OR pets.ID = '$searchTerm'";
							$searchResult = $conn->query($searchQuery);

							if ($searchResult->num_rows > 0)
							 {
							 	echo"<table  style='width:100%'>
											<tr>
												<th>ID</th>
								    			<th>Owner</th>
								    			<th>Petname</th>
								    			<th>PetType</th>
								    			<th>PetAge</th>
								    			<th>Update</th>
								    			<th>Delete</th>
								  			</tr> ";

							    // output data of each row
							    while($row = $searchResult->fetch_assoc()) {
							    	
							    	//create a table that shows owners and their pets
							        echo "<tr><td>" . $row['ID'] . "</td><td>". $row['ownerName'] . "</td><td>" . "<a href=petDetail.php?petID="  . $row['ID'] .  ">"  . $row['petName'] ."</a></td><td>" . $row['Type'] . "</td><td>" . $row['petAge'] . "</td><td>" .

							        		"<a href=deletePet.php?petID=" . $row['ID']. ">delete</a>" .
							        		 "</td><td><a href=petUpdate.php?petID=" . $row['ID']. "> UPDATE </a>" ."</tr>";
							    }
							    echo "</table>";
							}
						}
						else //Otherwise show the full database
						{
							$sql = "SELECT owners.Name as ownerName, pets.Name as petName, Type, pets.ID, pets.Age as petAge
								FROM owners JOIN pets ON pets.Owner_ID = owners.ID";
							$result = $conn->query($sql);

							echo"<table  style='width:100%'>
											<tr>
												<th>ID</th>
								    			<th>Owner</th>
								    			<th>Petname</th>
								    			<th>PetType</th>
								    			<th>PetAge</th>
								    			<th>Update</th>
								    			<th>Delete</th>
								  			</tr> ";

							if ($result->num_rows > 0)
							 {
							    // output data of each row
							    while($row = $result->fetch_assoc()) {


							    	//create a table that shows owners and their pets
							        echo "<tr><td>" . $row['ID'] . "</td><td>". $row['ownerName'] . "</td><td>" . "<a href=petDetail.php?petID="  . $row['ID'] .  ">"  . $row['petName'] ."</a></td><td>" . $row['Type'] . "</td><td>" . $row['petAge'] . "</td><td>" .

							        		"<a href=deletePet.php?petID=" . $row['ID']. ">delete</a>" .
							        		 "</td><td><a href=petUpdate.php?petID=" . $row['ID']. "> UPDATE </a>" ."</tr>";
							    	
							    	// //create a table that shows owners and their pets
							     //    echo "<p class='pets'>" . $row['ID'] . " | ". $row['ownerName'] . " | " . "<a href=petDetail.php?petID="  . $row['ID'] .  ">"  . $row['petName'] ."</a> | " . $row['Type'] . " | " . $row['petAge'] . " | " .

							     //    		"<a href=deletePet.php?petID=" . $row['ID']. ">delete</a>" .
							     //    		 " | <a href=petUpdate.php?petID=" . $row['ID']. "> UPDATE </a>" ."</p>";
							    }
							    echo "</table>";
							}
						}	
						
				?>
				


		</div>	
	</body>

</html>