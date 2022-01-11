<?php
include_once 'Includes/header.php';
require_once "Includes/views.php";
require_once "Includes/connect.php";

   
$page_id = 3;
$visitor_ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];

add_view($conn, $visitor_ip, $page_id, $browser);

?>

<html>
<head>
<script src="script.js"></script>
<script src='https://www.google.com/recaptcha/api.js' async defer ></script>
<link rel="stylesheet" href="login-style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>




    

<section class="signup">

<div class="form-container">
<h1> Log in</h1>
<br>
<p> To enjoy our site at full</p>
<form action="Includes/login.inc.php" method="POST" id="loginform" onsubmit="return validatecaptcha();">


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


<div class="g-recaptcha" data-sitekey="6Lfn8ekdAAAAAO5GJGjOUH5A3dD5JOr93GKhMMM-"></div>

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
        if($_GET["error"]=="emptyinputs"){
            echo "
            <p> You can't login without filling the inputs! </p>";
        }
    }

?>

</section>
</div>
</body>
<script>
  /*  $(document).ready(function(){ 
        $('#loginform').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: "Includes/login.inc.php",
                method: "POST",
                data:$(this).serialize(),
                dataType: "json",
                beforeSend: function(){
                        $('.submit btn').attr('disabled', 'disabled');
                }, 
                success: function(data) {
                    $('.submit btn').attr('disabled', false);
                    if(data.success){
                        $('#loginform')[0].reset();
                        grecaptcha.reset();
                    }
                }

            })


        })


    })*/
    function validatecaptcha() {
    var response = grecaptcha.getResponse();
    if (response.length === 0) {
        alert("please, validate captcha");
        return false;
    } else {
        //alert("validated");
        return true;
    }
}

</script>
</html>

<?php
Include_once "Includes/footer.php"; ?>