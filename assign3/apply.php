<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" >
  <meta name="description" content="Assignment 3" >
  <meta name="keywords" content="Application Form" >
  <meta name="author" content="Joshua Lillington-Moore" >
  <title>Apply</title>
  <!-- References to external font 'Blade Runner Font' -->
  <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' >
  <!-- References to external font 'Fallout 3 Computer Style Font' -->
  <link href='https://fonts.googleapis.com/css?family=Share+Tech+Mono' rel='stylesheet' >
  <!-- References to external font 'Cyberpunk 2077 Font -->
  <link href='https://fonts.googleapis.com/css?family=Rajdhani' rel='stylesheet' >
  <!-- References to external basic CSS file -->
  <link href= "styles/style.css" rel="stylesheet" >
  <script src="scripts/apply.js"></script>
</head>

<body>
	<?php
		include 'header.inc';
		include 'menu.inc';
	?>
<section class="form_container">
	<form id="formApply" method="post" action="processEOI.php" novalidate="novalidate" >
	<fieldset class="entire_form">
	<legend class="form_title">Application Form</legend>
	<p>
			<label for="reference">Job Reference Number</label>
			<input type="text" name="reference" id="reference" size="5" required="required" >
			<span id="refError" class="error"></span> <!--creates space for an error message, with java-->
	</p>
	<p>
			<label for="given_name">Given Name</label>
			<input type="text" name="given_name" id="given_name" size="20" pattern="^[a-zA-Z]+$" required="required" >
			<span id="givenError" class="error"></span>
	</p>
	<p>
			<label for="family_name">Family Name</label>
			<input type="text" name="family_name" id="family_name" size="20" pattern="^[a-zA-Z]+$" required="required" >
			<span id="familyError" class="error"></span>
	</p>	
	<p>
			<label for="dob"> Date of Birth</label>
			<input type="date" name="dob" id="dob" >
			<span id="dobError" class="error"></span>
	</p>
		<fieldset>
			<legend>Gender : </legend>
			<label for="male"> Male</label>
			<input type="radio" name="gender" id="male" required="required" value="male" >
			<label for="female"> Female</label>
			<input type="radio" name="gender" id="female" value="female" >
			<label for="unknown"> Rather Not Say</label>
			<input type="radio" name="gender" id="unknown" value="unknown" >
			<span id="genderError" class="error"></span>
		</fieldset>
		<p>
			<label for="street"> Street Address</label>
			<input type="text" name="street" id="street" size="40" required="required" >
			<span id="streetError" class="error"></span>
		</p>
		<p>
			<label for="sub_town"> Suburb/Town</label>
			<input type="text" name="sub_town" id="sub_town" size="40" required="required" >
			<span id="subError" class="error"></span>
		</p>	
			<label for="state"> State</label>
				<select name="state" id="state" required="required">
					<option value="">Please Select</option>
					<option value="VIC">VIC</option>
					<option value="NSW">NSW</option>
					<option value="QLD">QLD</option>
					<option value="NT">NT</option>
					<option value="WA">WA</option>
					<option value="SA">SA</option>
					<option value="TAS">TAS</option>
					<option value="ACT">ACT</option>
				</select>
			<span id="stateError" class="error"></span>
		<p>
			<label for="postcode"> Postcode</label>
			<input type="text" name="postcode" id="postcode" pattern="[0-9]{4}" required="required" >
			<span id="postError" class="error"></span>
		</p>
		<p>
			<label for="email"> Email</label>
			<input type="text" id="email" name="email" required="required" /> <!--pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"-->
			<span id="postError" class="error"></span>
		</p>
		<p>
			<label for="phone"> Phone Number</label>
			<input type="text" id="phone" name="phone" pattern="[0-9]{8,12}" required="required" >
			<span id="phoneError" class="error"></span>
		</p>
		<fieldset>
			<legend> Skill List</legend>
			<p>
				<label for="csharp"> C#</label>
					<input type="checkbox" id="csharp" name="skills[]" value="C#" checked="checked" required="required" >
				<label for="dotnet"> .NET Framework</label>
					<input type="checkbox" id="dotnet" name="skills[]" value=".NET Framework" > 
				<label for="gpu"> GPU</label>
					<input type="checkbox" id="gpu" name="skills[]" value="GPU" > 
				<label for="dX"> DirectX</label>
					<input type="checkbox" id="dX" name="skills[]" value="DirectX" > 
				<label for="other"> Other Skill...</label>
					<input type="checkbox" id="other" name="skill[]" value="Other Skill..." > 
				<span id="skillError" class="error"></span>
			</p>
			<p>
				<label for="others"> Other Skills </label>
				<br>
				<textarea id="others" name="others" rows="4" cols="40" placeholder="Please enter any other skills you possess..."></textarea>
				<span id="otherskillError" class="error"></span>
			</p>
		</fieldset>
	</fieldset>
	<br>
		<div class="errorMessages"></div> 
	<br>
		<input type="submit" value="Book" >
		<input type="reset" value="Reset Form" >
	</form>
</section>
	<?php
		include 'footer.inc';
	?>
</body>
</html>