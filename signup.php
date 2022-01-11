<?php
include_once 'Includes/header.php';
require_once "Includes/views.php";
require_once "Includes/connect.php";

   
    $page_id = 2;
    $visitor_ip = $_SERVER['REMOTE_ADDR'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    
    add_view($conn, $visitor_ip, $page_id, $browser);
   
    

?>

<html>
<head>
<script src="script.js"></script>
<link rel="stylesheet" href="login-style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>




    

<section class="signup">
<div class="container">
<h1> Vino alaturi de noi sa iti organizezi evenimentul tau de vis! </h1>
</div>
<div class="form-container">
<h1> Create a new account </h1>

<p> It's quick and simple! </p>
<form action="Includes/signup.inc.php" method="POST" onsubmit="return checkForm()">


<div>
 <input type="text" id="usri"  name="user" placeholder="Enter your username" autocomplete="off"
    readonly 
    onfocus="this.removeAttribute('readonly');" onchange="checkForm()"> 
    <i class="fa fa-check-circle"></i>
    <i class="fa fa-close"></i>
<div > <small id="errorUSER"><br></small></div>
</div>

<div>
 <input type="email" id="mail" name="email" placeholder="Email" onchange="checkForm()">
 <i class="fa fa-check-circle"></i>
    <i class="fa fa-close"></i>
<div ><small id="errorMAIL"><br></small></div>
</div>


<div>
<input class="pass" id="pass1" type="password" name="password1" placeholder="Enter your password" autocomplete="off"
onchange="checkForm()">
<i class="fa fa-check-circle"></i>
    <i class="fa fa-close"></i>
    <button type="button" id="show" onclick="myFunction()"><i class="fa fa-eye"></i></button>
<div ><small id="errorPASS1"><br></small></div>
</div>


<div>
<input class="pass" id="pass2" type="password" name="password2" placeholder="RE-Enter your password" autocomplete="off"
    readonly 
    onfocus="this.removeAttribute('readonly');" onchange="checkForm()" > 
    <i class="fa fa-check-circle"></i>
    <i class="fa fa-close"></i>
<button type="button" id="show" onclick="myFunction()"><i class="fa fa-eye" id="open"></i></button>
<div ><small id="errorPASS2"><br></small></div> 
</div>

<button type="submit" name="submit" class="submit btn">Sign up</button>
<br>
<div>
    <p> Already signed up? </p> <a href="/login.php">Log in!</a>
</div>
</form>

<?php
    
   
    if(isset($_GET["error"])) {
        
        if ($_GET["error"] == "emptyinputs") {
            echo "<p> Please fill in the required fields </p>";}
        if($_GET["error"] == "invaliduser") {
            echo "<p> Please enter a proper username </p>";}
        if($_GET["error"] == "invalidpass"){
            echo "<p> Enter a proper password </p>";
        }
        if($_GET["error"] == "invalidemail"){
            echo "<p> Enter a proper mail </p>";
        }
        if($_GET["error"] == "usertaken"){
            echo "<p> Username already taken, try again, or  <a href='/login.php'>Log in!</a> ";
        }
        if($_GET["error"] == "emailtaken"){
            echo "<p> Email already taken, try again, or <a href='/login.php'>Log in!</a>";
        }
        if($_GET["error"] == "none") {
            echo "<p> A verification mail was sent to " . $_GET["mail"] . "!</p>";
        }
        
        
        
    }

?>





</section>

</div>
<?php
include_once 'Includes/footer.php';

?>
</body>

</html>

