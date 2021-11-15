<?php
include_once 'Includes/header.php';


?>

<html>
<head>
<script src="script.js"></script>
<link rel="stylesheet" href="login-style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>




    

<section class="signup">

<div class="form-container">
<h1> Log in</h1>
<br>
<p> To enjoy our site at full</p>
<form action="Includes/login.inc.php" method="POST" onsubmit="return checkForm()">


<div>
 <input type="text" id="usri"  name="user" placeholder="Username or Email" autocomplete="off"
    readonly 
    onfocus="this.removeAttribute('readonly');" onchange="checkForm()"> 
    <i class="fa fa-check-circle"></i>
    <i class="fa fa-close"></i>
<div > <small id="errorUSER"><br></small></div>
</div>




<div>
<input class="pass" id="pass1" type="password" name="password1" placeholder="Enter your password" autocomplete="off"
onchange="checkForm()">
<i class="fa fa-check-circle"></i>
    <i class="fa fa-close"></i>
    <button type="button" id="show" onclick="myFunction()"><i class="fa fa-eye"></i></button>
<div ><small id="errorPASS1"><br></small></div>
</div>




<button type="submit" name="submit" class="submit btn">Log in</button>
<br>
<div>
     <a href="/login.php">Forgot your password?</a>
     <p> Don't have an account?</p><a href="/signup.php">Sign up now! </a>
</div>
</form>
<?php 
    if(isset($_GET["error"])){
        if($_GET["error"]=="verify"){
            echo "
            <p> Your account has not been verified! </p>
            <p>Please check your email inbox to verify your account;</p>";
        }
    }

?>

</section>
</div>
</body>
</html>

<?php
Include_once "Includes/footer.php"; ?>