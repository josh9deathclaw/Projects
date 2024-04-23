<!-- references 
https://owlcation.com/stem/Simple-search-PHP-MySQL
https://stackoverflow.com/questions/35221716/php-advanced-search-with-multiple-option
https://www.elithecomputerguy.com/2019/12/mysql-search-form-with-html-and-php/
https://stackoverflow.com/questions/547821/two-submit-buttons-in-one-form 
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage</title>
<meta charset="utf-8" />
<meta name="description" content="Assignment 3, Manage Applications" />
<meta name="keywords" content="PHP, File, input, output" />
<link rel="stylesheet" href="style.css" type="text/css" />
 <!-- References to external font 'Blade Runner Font' -->
  <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' >
  <!-- References to external font 'Fallout 3 Computer Style Font' -->
  <link href='https://fonts.googleapis.com/css?family=Share+Tech+Mono' rel='stylesheet' >
  <!-- References to external font 'Cyberpunk 2077 Font -->
  <link href='https://fonts.googleapis.com/css?family=Rajdhani' rel='stylesheet' >
  <!-- References to external basic CSS file -->
  <link href= "styles/style.css" rel="stylesheet" >
  <script src="scripts/apply.js"></script>
<!-- Description: Query Selector -->
<!-- Author: Joshua -->
<!-- Date: 17/10/23 -->
</head>
<body>
	<?php
		include 'header.inc';
		include 'menu.inc';
	?>
	<h1 class = "managetitle">Manage Applications</h1>
	<section class="form_container">
	<form class = "manageform" method="post" action="manage.php">
	<legend class="form_title">Member Search</legend>
		<p>	<label for="eoino">EOI : </label>
			<input type="text" name="eoino" id="eoino" />
		</p>
		<p>	<label for="reference_id">Reference: </label>
			<input type="text" name="reference_id" id="reference_id" />
		</p>
		<p>	<label for="gname">Given Name : </label>
			<input type="text" name="gname" id="gname" />
		</p>
		<p>	<label for="fname">Family Name : </label>
			<input type="text" name="fname" id="fname" />
		</p>
		<p>	<input type="submit" name="search" value="Search" />
			<input type="submit" name="delete_by_ref" value="Delete" /></p>
			<input type="submit" name="show_all" value="Show All Applications" />
		</p>
		<p> <label for="status">Update Status: </label>
                <select name="status" id="status">
                    <option value="New">New</option>
                    <option value="Current">Current</option>
                    <option value="Final">Final</option>
                </select>
                <input type="submit" name="update_status" value="Update Status" />
		</p>
	</form>
	</section>
	<hr />
<div class="timetable">
<?php
	$reference_id = ($_POST["reference_id"]);
	$eoino = ($_POST["eoino"]);
	$status = ($_POST["status"]);
	$gname = ($_POST["gname"]);
	$fname = ($_POST["fname"]);
    require_once('settings.php');
    //delete Query
	//DELETE FROM eoi WHERE reference = '$reference_id'
	
	$conn = @mysqli_connect($host,
		$user,
		$pwd,
		$sql_db
	);
  
	// Checks if connection is successful
	if (!$conn) {
		// Displays an error message
		echo "<p class=\"wrong\">Database connection failure</p>"; // Might not show in a production script 
	} else {
		// Upon successful connection
		
	$sql_table="eoi";
	//define a variable for search conditions
	$search_cond = "";
	if($reference_id != ""){ 
		if($search_cond != ""){ //if search condition is not blank, add an AND, so can search for multiple options or just one
			$search_cond .= "AND ";
		}
		$search_cond .= "reference LIKE '$reference_id'";
	}
	if($gname != ""){
		if ($search_cond != ""){
			$search_cond .= "AND ";
		}
		$search_cond .= "given_name LIKE '$gname'";
	}
	if($fname != ""){
		if ($search_cond != ""){
			$search_cond .= "AND ";
		}
		$search_cond .= "family_name LIKE '$fname'";
	}
	if($search_cond != ""){
		$search_cond = " WHERE " . $search_cond;
	}
	
	$query_search = "SELECT * FROM $sql_table" . $search_cond;
		// Set up the SQL command to add the data into the table
		/*$query_search = "SELECT * FROM eoi WHERE reference = '$reference_id'";
		if(!empty($gname)){
			$query_search .= " AND given_name LIKE '$gname'";
		}//if given name not empty, include it in the search
		if(!empty($fname)){
			$query_search .= " AND family_name LIKE '$fname'";
		}*/
		$query_delete = "DELETE FROM eoi WHERE reference = '$reference_id'";
		$query_all = "SELECT * FROM eoi";
		$query_update_status = "UPDATE eoi SET status = '$status' WHERE eoinumber = '$eoino'";
	if (isset($_POST['search'])){
		// execute the query and store result into the result pointer
		$result = mysqli_query($conn, $query_search);
		
		// checks if the execuion was successful
		if(!$result) {
			echo "<p class=\"wrong\">Something is wrong with ",	$query_search, "</p>";
		} else {
		if(mysqli_num_rows($result)>0) {
			// Display the retrieved records
			echo "<table border=\"1\">";
			echo "<tr>\n"
				 ."<th scope=\"col\">EOI Number</th>\n"
				 ."<th scope=\"col\">Reference Number</th>\n"
			     ."<th scope=\"col\">Given Name</th>\n"
				 ."<th scope=\"col\">Family Name</th>\n"
				 ."<th scope=\"col\">Date of Birth</th>\n"
				 ."<th scope=\"col\">Gender</th>\n"
				 ."<th scope=\"col\">Street</th>\n"
				 ."<th scope=\"col\">Suburb</th>\n"
				 ."<th scope=\"col\">State</th>\n"
				 ."<th scope=\"col\">Postcode</th>\n"
				 ."<th scope=\"col\">Email</th>\n"
				 ."<th scope=\"col\">Phone</th>\n"
				 ."<th scope=\"col\">Skills</th>\n"
				 ."<th scope=\"col\">Others</th>\n"
				 ."<th scope=\"col\">Application Date</th>\n"
				 ."<th scope=\"col\">Status</th>\n"
				 ."</tr>\n";
			// retrieve current record pointed by the result pointer
			
			while ($row = mysqli_fetch_assoc($result)){
				echo "<tr>";
				echo "<td>",$row["eoinumber"],"</td>";
				echo "<td>",$row["reference"],"</td>";
				echo "<td>",$row["given_name"],"</td>";  
				echo "<td>",$row["family_name"],"</td>";
				echo "<td>",$row["dob"],"</td>";
				echo "<td>",$row["gender"],"</td>";
				echo "<td>",$row["street"],"</td>";
				echo "<td>",$row["sub_town"],"</td>";
				echo "<td>",$row["state"],"</td>";
				echo "<td>",$row["postcode"],"</td>";
				echo "<td>",$row["email"],"</td>";
				echo "<td>",$row["phone"],"</td>";
				echo "<td>",$row["skills"],"</td>";
				echo "<td>",$row["others"],"</td>";
				echo "<td>",$row["application_date"],"</td>";
				echo "<td>",$row["status"],"</td>";
				echo "</tr>";
			}
			echo "</table>";
			// Frees up the memory, after using the result pointer
			mysqli_free_result($result);
		} else			// if successful query operation
			echo "<p>No matching records found</p>";
		} // end if no rows
	}else if (isset($_POST['delete_by_ref'])){
			// execute the query and store result into the result pointer
		$result = mysqli_query($conn, $query_delete);
		echo "<p>All Records with Reference ID $reference_id Deleted from Table EOI </p>";
	}else if (isset($_POST['update_status'])){
		$result = mysqli_query($conn, $query_update_status);
		echo "<p>Application $eoino status updated to $status</p>";
	}else if (isset($_POST['show_all'])){
		// execute the query and store result into the result pointer
		$result = mysqli_query($conn, $query_all);
		
		// checks if the execuion was successful
		if(!$result) {
			echo "<p class=\"wrong\">Something is wrong with ",	$query_all, "</p>";
		} else {
		if(mysqli_num_rows($result)>0) {
			// Display the retrieved records
			echo "<table border=\"1\">";
			echo "<tr>\n"
				 ."<th scope=\"col\">EOI Number</th>\n"
				 ."<th scope=\"col\">Reference Number</th>\n"
			     ."<th scope=\"col\">Given Name</th>\n"
				 ."<th scope=\"col\">Family Name</th>\n"
				 ."<th scope=\"col\">Date of Birth</th>\n"
				 ."<th scope=\"col\">Gender</th>\n"
				 ."<th scope=\"col\">Street</th>\n"
				 ."<th scope=\"col\">Suburb</th>\n"
				 ."<th scope=\"col\">State</th>\n"
				 ."<th scope=\"col\">Postcode</th>\n"
				 ."<th scope=\"col\">Email</th>\n"
				 ."<th scope=\"col\">Phone</th>\n"
				 ."<th scope=\"col\">Skills</th>\n"
				 ."<th scope=\"col\">Others</th>\n"
				 ."<th scope=\"col\">Application Date</th>\n"
				 ."<th scope=\"col\">Status</th>\n"
				 ."</tr>\n";
			// retrieve current record pointed by the result pointer
			
			while ($row = mysqli_fetch_assoc($result)){
				echo "<tr>";
				echo "<td>",$row["eoinumber"],"</td>";
				echo "<td>",$row["reference"],"</td>";
				echo "<td>",$row["given_name"],"</td>";  
				echo "<td>",$row["family_name"],"</td>";
				echo "<td>",$row["dob"],"</td>";
				echo "<td>",$row["gender"],"</td>";
				echo "<td>",$row["street"],"</td>";
				echo "<td>",$row["sub_town"],"</td>";
				echo "<td>",$row["state"],"</td>";
				echo "<td>",$row["postcode"],"</td>";
				echo "<td>",$row["email"],"</td>";
				echo "<td>",$row["phone"],"</td>";
				echo "<td>",$row["skills"],"</td>";
				echo "<td>",$row["others"],"</td>";
				echo "<td>",$row["application_date"],"</td>";
				echo "<td>",$row["status"],"</td>";
				echo "</tr>";
			}
			echo "</table>";
			// Frees up the memory, after using the result pointer
			mysqli_free_result($result);
		} else			// if successful query operation
			echo "<p>No matching records found</p>";
		} // end if no rows
		// close the database connection
	} // if successful database connection
	mysqli_close($conn);
	} // if null string // if data posted
?>
</div>
	<?php
		include 'footer.inc';
	?>
</body>
</html>