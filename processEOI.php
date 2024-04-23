<!-- references
https://html.form.guide/php-form/php-form-checkbox/ 
https://larryullman.com/forums/index.php?/topic/1839-form-validation-radio-buttons/
https://medium.com/nerd-for-tech/how-to-validate-your-forms-server-side-with-php-75680d04971b
-->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Lab 10" />
<meta name="keywords" content="PHP, mySQL" />
<title>Process Form and Server-side Validation</title>
</head>
<body>
<?php 
	//if a user entered this url, redirect them back to the form to apply
	if (!isset($_SERVER["HTTP_REFERER"])){
		header('location:apply.php');
		echo "Access denied. You can't access this page directly.";
		exit;
	}
	require_once ("settings.php"); //connections info
	
	$connect = @mysqli_connect($host,
			$user,
			$pwd,
			$sql_db
			);
	//check if the connection is successful
	if (!$connect){
			//connection failed, display an error message
			echo "<p>Database connection failure</p>"; //not in production script
	}else {
	//upon successful connection
	//get tabls name
	$sql_table="eoi";
	
	//create a fucntion that can be used to sanitise the input from the form
	function sanitise($data){
		$data = trim($data); //removes spaces
		$data = htmlspecialchars($data); //converts special characters
		$data = stripslashes($data); //removes backslashes in front of quotes
		return $data;
	}
	//create blank error message, filled depending on the errors which occur
	$errMsg = "";
	//get the data using post from the form, than do server side validation
		//exactly 5 alphanumeric characters
		$reference = sanitise($_POST["reference"]);
		if(!preg_match("/^[A-Za-z0-9]{5}$/", $reference)){
			$errMsg .= "<p>Reference can only contain alphanumeric characters and exactly 5 characters.</p>\n";
		}
		//20 max alphabetical characters
		$given_name	= sanitise($_POST["given_name"]);
		if(!preg_match("/^[a-zA-Z]{1,25}$/", $given_name)){
			$errMsg .= "<p>Given name must contain only alphabetical characters in between 1-20 characters.</p>\n";
		}	
		$family_name = sanitise($_POST["family_name"]);
		if(!preg_match("/^[a-zA-Z]{1,20}$/", $family_name)){
			$errMsg .= "<p>Family name must contain only alphabetical characters in between 1-20 characters.</p>\n";
		}
		//validation, dob between 15 and 80 years old 
		$dob = sanitise($_POST["dob"]);
		$age = date_diff(date_create($dob), date_create('now'))->y;
		if($age < 15 || $age > 80){
				$errMsg .= "<p>You must be between 15 and 80 years old.</p>\n";
		}
		//check that gender has been selected
		$gender	= sanitise($_POST["gender"]);
		if(empty($_POST['gender'])){
			$errMsg .= "<p>Please select a gender.</p>\n";
		}
		
		//max 40 characters
		$street	= sanitise($_POST["street"]);
		if(!preg_match("/^[a-zA-Z0-9 ,.'-]{1,40}$/", $street)){
			$errMsg .= "<p>Street Address must contain only alphabetical characters in between 1-40 characters.</p>\n";
		}
		$sub_town = sanitise($_POST["sub_town"]);
		if(!preg_match("/^[a-zA-Z0-9]{1,40}$/", $sub_town)){
			$errMsg .= "<p>Suburb must contain only alphabetical characters in between 1-40 characters.</p>\n";
		}
		//one of VIC,NSW,QLD,NT,WA etc
		$state	= sanitise($_POST["state"]);
		if($state == "none"){
			$errMsg .= "<p>You must select your state.</p>\n";
		}
		//exactly 4 digits, matches state
		$postcode = sanitise($_POST["postcode"]);
		if(!preg_match("/^\d{4}$/", $postcode)){
			$errMsg .= "<p>Postcode must be exactly 4 digits.</p>\n";
		} else{
			switch($state){
				case "VIC":
					if (!(($postcode >= 3000 && $postcode <= 3999) || ($postcode >= 8000 && $postcode <= 8999))){
					$errMsg .= "<p>Not a Victorian Postcode</p>\n";
					}
				break;
				case "NSW":
					if (!($postcode >= 1000 && $postcode <= 2999)){
					$errMsg .= "<p>Postcode not located in New South Whales</p>\n";
					}
				break;
				case "QLD":
					if (!(($postcode >= 4000 && $postcode <= 4999) || ($postcode >= 9000 && $postcode <= 9999))){
					$errMsg .= "<p>Postcode not located in QLD</p>\n";
					}
				break;
				case "NT":
				case "ACT":
					if (!($postcode >= 0 && $postcode <= 999)){ 
					$errMsg .= "<p>Postcode not located in the Northern Terroritory</p>\n";
					}
				break;
				case "WA":
					if (!($postcode >= 6000 && $postcode <= 6999)){
					$errMsg .= "<p>Not a Western Australian Postcode</p>\n";
				}
				break;
				case "SA":
					if (!($postcode >= 5000 && $postcode <= 5999)){
					$errMsg .= "<p>Not a South Australian Postcode</p>\n";
				}
				break;
				case "TAS":
					if (!($postcode >= 7000 && $postcode <= 7999)){
					$errMsg .= "<p>Not a Tasmanian Postcode</p>\n";
				}
				break;
			default:
				$errMsg .= "<p>Postcode Not Valid.</p>\n"; 
			}
		}
		
		//validate email format
		$email	= sanitise($_POST["email"]);
		if(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z\.]{2,}$/", $email)){
			$errMsg .= "<p>Email is not valid, format is 'example@example.com' .</p>\n";
		}
		//8 to 12 digits or spaces
		$phone	= sanitise($_POST["phone"]);
		if(!preg_match("/^[0-9 ]{8,12}$/", $phone)){
			$errMsg .= "<p>Phone number must have 8-12 digits or spaces</p>\n";
		}
		//for the checkbox for skills, make it into array that adds onto each other as string
		$skill_string = "";
		if (isset($_POST['skills']) && is_array($_POST['skills'])){ //loop through each selected skill and add them to the array
			foreach ($_POST['skills'] as $skill){
				if($skill_string != ""){ //if string is not empty, add , in order too make it visually appealing
					$skill_string .= ", ";
				}
				$skill_string .= $skill;
			}
		}
		$skills = $skill_string;
		
		//check that others text box cannot be empty if check box selected
		$others = sanitise($_POST["others"]);
		if(strpos($skills, "other") !== false){
			if($others == ""){
				$errMsg .= "<p>If other skills is selected, the text area cannot be left empty.</p>\n";
			}
		}
		//if error message is not empty, send user back to the form
		if ($errMsg != ""){
			die($errMsg . "\n<p><a href=\"apply.php\"> Return to Application</a></p>");
		}
	
	//check if table exists, if not, create one
	$create_table = "CREATE TABLE IF NOT EXISTS $sql_table(
			eoinumber INT AUTO_INCREMENT PRIMARY KEY,
			reference CHAR(5) NOT NULL,
			given_name VARCHAR(20) NOT NULL,
			family_name VARCHAR(40) NOT NULL,
			dob DATE NOT NULL,
			gender VARCHAR(6),
			street VARCHAR(40) NOT NULL,
			sub_town VARCHAR(40) NOT NULL,
			state VARCHAR(40) NOT NULL, 
			postcode INT NOT NULL,
			email VARCHAR(20) NOT NULL,
			phone VARCHAR(20) NOT NULL,
			skills VARCHAR(200),
			others VARCHAR(200),
			application_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
			status CHAR(10) DEFAULT 'New',
			CONSTRAINT CHK_status CHECK(status IN ('New', 'Current', 'Final'))
			)";
	$open_table = @mysqli_query($connect, $create_table);
	if(!$open_table){
		die("Table creation failed: " . mysqli_error($connect)); //if query did not work
	}else{
		//the table exists, either preexisting or has been created
		//enter new record to the expression of interest data
		$new_application = "INSERT INTO $sql_table"
				."(reference, given_name, family_name, dob, gender, street, sub_town, state, postcode, email, phone, skills, others)"
						. " VALUES "
								."('$reference', '$given_name', '$family_name', '$dob', '$gender', '$street', '$sub_town',
								   '$state', '$postcode', '$email', '$phone', '$skills', '$others')";
		$add_applicant = @mysqli_query($connect, $new_application);
		//check if new record has been added
		if(!$add_applicant){
			echo "<h1>Failed to save application</h1>";
		}else{
			echo "<h1>Thankyou for your application</h1>";
			echo "<p>Your application ID is: <strong> " . mysqli_insert_id($connect) . "</strong></p>";
			echo "<p>Apply for other positions <a href=\"apply.php\">here.</a></p>";
		}
		//close the connection
		@mysqli_close($connect);
		}
	}
?>
</body>
</html>