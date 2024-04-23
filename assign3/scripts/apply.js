/*references :
https://developer.mozilla.org/en-US/docs/Web/API/Window/sessionStorage

https://www.youtube.com/watch?v=In0nB0ABaUk - JavaScript Form Validation

https://www.youtube.com/watch?v=rsd4FNGTRBw - JavaScript Client-side Form Validation

https://developer.mozilla.org/en-US/docs/Learn/Forms/Form_validation 

https://www.youtube.com/watch?v=fz8bwvn9lA4 - How To Make Form Validation Using JavaScript | Validate Form Using JavaScript

https://www.javatpoint.com/calculate-age-using-javascript 

https://stackoverflow.com/questions/21511817/javascript-using-html5-local-storage-to-store-form-data-and-to-present-it-on-t 
*/

/*
filename: apply.js
author: joshua lillington
purpose: javascript file, includes code required to do further validation as well as a storing data both locally and in a session
created: 24/09/2023
last modified: 25/09/2023
description: assign2
*/
"use strict"; //constants cant be used

function validate(){
	//error messages so it can be separate for each
	var givenError = document.getElementById('givenError');
	var dobError = document.getElementById('dobError');
	var stateError = document.getElementById('stateError');
	var postError = document.getElementById('postError');
	var otherskillError = document.getElementById('otherskillError');
	
	var errMsg = "";
	var result = true;
	var errorMessages = document.querySelector(".errorMessages");
	
	var reference = document.getElementById("reference").value; //a lot of the patterns in the apply.html overwrite the validation done here, making it unnessecary
		if (reference == ""){
		errMsg += "Please enter a Job Reference\n";
		result = false;
	}
	
	var given_name = document.getElementById("given_name").value; 
	if (!given_name.match(/^[a-zA-Z]+$/)){
		errMsg = errMsg + "Your First Name must only contain alpha characters\n";
		givenError.innerHTML = "Name is Required";
		result = false;
	}
	
	var family_name = document.getElementById("family_name").value; 
	if (!family_name.match(/^[a-zA-Z\-]+$/)){
		errMsg = errMsg + "Your Last Name can only contain alpha characters or hyphens\n";
		result = false;
	}
	//check dob and age range is valid
	var dob = document.getElementById("dob").value; 
	/*if (!dob.match(/\d{2}\/\d{2}\/\d{4}/)){
		errMsg = errMsg + "Please enter a valid Date of Birth\n";
	}*/
	var age = calcAge(dob);
	if (age < 15 || age > 80){
		dobError.innerHTML = "Applicants must be between 15 and 80 years old\n";
		result = false;
	}
	//check if street entered
	var street = document.getElementById("street").value; 
	if (street == ""){
		errMsg += "Please enter an Address\n";
		result = false;
	}
	
	var sub_town = document.getElementById("sub_town").value; 
		if (sub_town == ""){
		errMsg += "Please enter a Suburb\n";
		result = false;
	}
	
	var state = document.getElementById("state").value; 
		if (state == ""){
		stateError.innerHTML = "Please select a State";
		result = false;
	}	else {
		var postcode = document.getElementById("postcode").value;
		var tempMsg = postCodeValidate(state, postcode); //
		if (tempMsg != ""){
			postError.innerHTML = tempMsg;
			result = false;
		}
	}
	
	var postcode = document.getElementById("postcode").value;
		if (postcode == ""){
		errMsg += "Please enter an Postcode\n";
		result = false;
	}
	
	var phone = document.getElementById("phone").value; 
		if (phone == ""){
		errMsg += "Please enter a Phone Number\n";
		result = false;
	}
	
	//radio
	var csharp = document.getElementById("csharp").checked;
	var dotnet = document.getElementById("dotnet").checked;
	var gpu = document.getElementById("gpu").checked;
	var dX = document.getElementById("dX").checked;
	var other = document.getElementById("other").checked;
	if(!(csharp || dotnet || gpu || dX || other)){
		errMsg += "Please select at least one skill/n";
		result = false;
	}
	if (other){
		var others = document.getElementById("others").value;  //if someone selects other skills, have to enter an answer in the text area
		if (others == ""){
			errMsg += "You have selected other skills, do not leave the text area blank";
			otherskillError.innerHTML = "Do not leave the text area blank\n";
			result = false;
		}
	}
	
	//validate if gender is checked 
	var male = document.getElementById("male").checked;
	var female = document.getElementById("female").checked;
	var unknown = document.getElementById("unknown").checked;
	if(!(male || female || unknown)){
		errMsg += "Please select a gender option/n";
		result = false;
	}
	//get variables from form and check rules here
	//if something is wrong set result = false, and concatenate error message
	if (errMsg != ""){	//only display message box if there is something to show
		errorMessages.innerHTML = "Please Correct Remaining Error";
	}else{
		errorMessages.innerHTML = "";
	}
	if (result){
		storeApplication(given_name, family_name, dob, street, sub_town, state, postcode, phone, male, female, other, csharp, dotnet, gpu, dX, other, others);
	}
	return result;
}

//between age of 15-80 and in style dd/mm/yyyy
function calcAge(dob){
	//get current input for dob and the current date
	var dobDate = new Date(dob);
	var currentDate = new Date();
	//calculate age difference
	var age = currentDate.getFullYear() - dobDate.getFullYear();
	return age;
}

//validate postcode
function postCodeValidate (state, postcode){ 
	var errMsg = "";
	switch(state){ //use switch case
		case "VIC": //depending on the state, it looks at what the postcode is, will give an error message is conditions are met
			if (!((postcode >= 3000 && postcode <= 3999) || (postcode >= 8000 && postcode <= 8999))){
				errMsg += "Not a Victorian Postcode";
			}
			break;
		case "NSW":
			if (!(postcode >= 1000 && postcode <= 2999)){
				errMsg += "Postcode not located in New South Whales";
			}
			break;
		case "QLD":
			if (!((postcode >= 4000 && postcode <= 4999) || (postcode >= 9000 && postcode <= 9999))){
				errMsg += "Postcode not located in " + state;
			}
			break;
		case "NT":
		case "ACT":
			if (!(postcode >= 0 && postcode <= 999)){ 
				errMsg += "Postcode not located in the Northern Terroritory";
			}
			break;
		case "WA":
			if (!(postcode >= 6000 && postcode <= 6999)){
				errMsg += "Not a Western Australian Postcode";
			}
			break;
		case "SA":
			if (!(postcode >= 5000 && postcode <= 5999)){
				errMsg += "Not a South Australian Postcode";
			}
			break;
		case "TAS":
			if (!(postcode >= 7000 && postcode <= 7999)){
				errMsg += "Not a Tasmanian Postcode";
			}
			break;
		default:
			errMsg = "Postcode Not Valid."; 
	}
	return errMsg;
}

//get id from the local storage if the apply button has been pressed, make read only
function prefill_ID(){
	var jobIdinput = document.getElementById("reference"); 
	if(localStorage.reference != undefined){ //if jobId has a value, set as read only, otherwise dont and allow for it to be edited
		jobIdinput.value = localStorage.reference; //store locally
		jobIdinput.readOnly = true;
	}else{
		jobIdinput.readOnly = false;
	}
}

//if user has already submitted a form, when they try again, bring up there previous information from session storage
function prefillForm(){
	prefill_ID();
	if(sessionStorage.given_name != undefined){ //if storage for username is not empty
		document.getElementById("given_name").value = sessionStorage.given_name; 
		document.getElementById("family_name").value = sessionStorage.family_name;
		document.getElementById("dob").value = sessionStorage.dob;
		document.getElementById("street").value = sessionStorage.street;
		document.getElementById("sub_town").value = sessionStorage.sub_town;
		document.getElementById("state").value = sessionStorage.state;
		document.getElementById("postcode").value = sessionStorage.postcode;
		document.getElementById("phone").value = sessionStorage.phone;
		
		switch(sessionStorage.gender){ //writing checkboxes takes more work
			case "male":
				document.getElementById("male").checked = true;
				break;
			case "female":
				document.getElementById("female").checked = true;
				break;
			case "other":
				document.getElementById("other").checked = true;
				break;
		}
		document.getElementById("csharp").checked = sessionStorage.csharp === "true";
		document.getElementById("dotnet").checked = sessionStorage.dotnet === "true";
		document.getElementById("gpu").checked = sessionStorage.gpu === "true";
		document.getElementById("dX").checked = sessionStorage.dX === "true";
	}
}

//prefill the jobID if the apply link has been clicked
function storeJobId1(){
	localStorage.reference = document.getElementById("job1id").innerHTML; //stores the jobID which is in brackets next to job1id, for example job1id("10001")
}
function storeJobId2(){
	localStorage.reference = document.getElementById("job2id").innerHTML; 
}

//stores application 
function storeApplication(given_name, family_name, dob, street, sub_town, state, postcode, phone, male, female, other, csharp, dotnet, gpu, dX, others){
	//get values and assign them to a sessionStorage attribute
	//we use the same name for the attribute and the element id to avoid confusion
	sessionStorage.given_name = given_name;
	sessionStorage.family_name = family_name;
	sessionStorage.dob = dob;
	sessionStorage.street = street;
	sessionStorage.sub_town = sub_town;
	sessionStorage.state = state;
	sessionStorage.postcode = postcode;
	sessionStorage.phone = phone;
	sessionStorage.csharp = csharp;
	sessionStorage.dotnet = dotnet;
	sessionStorage.gpu = gpu;
	sessionStorage.dX = dX;
	sessionStorage.others = others;
	
	if (male){
		sessionStorage.gender = "male";
	}else if (female){
		sessionStorage.gender = "female";
	}else if (other){
		sessionStorage.gender = "other";
	}
	
	alert ("Application Complete"); //added for testing
}

//on load up
function init(){
	if(document.title == "Jobs"){ //checks what page the website is on
		document.getElementById("applyJob1").onclick = storeJobId1; //if on page jobs, when user clicks on either apply button,
		document.getElementById("applyJob2").onclick = storeJobId2; //refers to storeJobId(1or2) which stores the job ID in the local storage
	}else if(document.title == "Apply"){
		//is working locally, but not on the mercury server, trying to debug unsure if it will just fix itself
		prefillForm(); //refers to function prefill form, so when a user applies for a job, it will save there information from before
		document.getElementById("formApply").onsubmit = validate; //when user submits form, refers to validate function to check everything 
		document.getElementById("formApply").onreset = function(){ //clears the local storage
			localStorage.clear();
			prefill_ID();
		}
	}
}
window.onload = init;