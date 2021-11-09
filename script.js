/*const form = document.getElementById('form');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');

function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'form-control error';
	small.innerText = message;
}

function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'form-control success';
}
	
function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function checkInputs() {
	// trim to remove the whitespaces
	const usernameValue = username.value.trim();
	const emailValue = email.value.trim();
	const passwordValue = password.value.trim();
	const password2Value = password2.value.trim();
	
	if(usernameValue === '') {
		setErrorFor(username, 'Username cannot be blank');
    return false;
	} else {
		setSuccessFor(username);
	}
	
	if(emailValue === '') {
		setErrorFor(email, 'Email cannot be blank');
    return false;
	} else if (!isEmail(emailValue)) {
		setErrorFor(email, 'Not a valid email');
    return false;
	} else {
		setSuccessFor(email);
	}
	
	if(passwordValue === '') {
    
		setErrorFor(password, 'Password cannot be blank');
    return false;
	} else {
		setSuccessFor(password);
	}
	
	if(password2Value === '') {
		setErrorFor(password2, 'Password2 cannot be blank');
    return false;
	} else if(passwordValue !== password2Value) {
		setErrorFor(password2, 'Passwords does not match');
    return false;
	} else{
		setSuccessFor(password2);
	}
return true;
}*/
/*
function setSuccessFor(input) {
	input.className = "verify";
}*/
function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function setSuccessFor(input) {
	input.classList.remove("error");
	const formControl = input.parentElement;
	input.classList.add("verify"); 
	const icon1= formControl.querySelector(".fa.fa-check-circle");
	icon1.style.display = "inline-block";
	const icon2 = formControl.querySelector(".fa.fa-close");
	icon2.style.display = "none";
	const msg = formControl.querySelector("small");
//	msg.style.display = "none";
	msg.innerHTML = "<br>";
	
}

function SetErrorFor(input, message){
	input.classList.remove("verify");
	const formControl = input.parentElement;
	input.classList.add("error");
	const msg = formControl.querySelector("small"); 
	msg.innerHTML = message;
	const icon1 = formControl.querySelector(".fa.fa-check-circle");
	icon1.style.display = "none";
	const icon2 = formControl.querySelector(".fa.fa-close");
	icon2.style.display = "inline-block";

}

function myFunction() {

	var x = document.getElementsByClassName("pass");
	for (let i=0; i<x.length; i++) {
	if (x[i].type === "password") {
		
	  x[i].type = "text";
	} else {
	  x[i].type = "password";
	}
  }}


function checkForm(){
  //client side (JS) validation. This happens before submitting.
  var username = document.getElementById("usri");
  var mail = document.getElementById("mail")
  var password1 = document.getElementById("pass1");
  var password2 = document.getElementById("pass2");
  

  var username_value = document.forms[0].user.value.trim();
  var mails_value = document.forms[0].email.value.trim();
  var pass1_value = password1.value.trim();
  var pass2_value = password2.value.trim();

  
  if(username_value.length < 3 || username_value.length > 12){ 
  	
		SetErrorFor(username, "username should be between 3 and 12 characters");
		
  	 	return false;
	}else{/*document.getElementById("errorUSER").innerHTML = "";*/ setSuccessFor(username);}
	
  if (mails_value.trim().length == 0 ){
	/*	var error2 = "email can't be blank";
		document.getElementById("errorMAIL").innerHTML = error2; */
		SetErrorFor(mail, "Email can't be blank!");
		
		return false;
	  }
  if(mails_value.length < 5 ){
    var error2 = "email length should be greater than 5";
    SetErrorFor(mail, "Email length should be greater than 5");
    return false;
  }
  if(!isEmail(mails_value)){SetErrorFor(mail, "Not a valid email"); return false;} 
  else {document.getElementById("errorMAIL").innerHTML = ""; setSuccessFor(mail);}
  if(pass1_value.length < 1) {
	  SetErrorFor(password1, "password can't be empty"); 
  	  return false;}else {document.getElementById("errorPASS1").innerHTML = "";setSuccessFor(password1); }
  if(pass1_value != pass2_value) {SetErrorFor(password2, "passwords don't match"); return false;}
  else {document.getElementById("errorPASS2").innerHTML = ""; setSuccessFor(password2);}
  




  
  return true;
}














