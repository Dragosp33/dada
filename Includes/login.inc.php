<?php
if(isset($_POST["submit"])) {

//get post data
$userL = $_POST['user'];
$user = str_replace(" ", "", $userL);
$password1 = trim($_POST['password1']);
require_once 'connect.php';
require_once 'functions.inc.php';
    if(emptyInput2($user, $password1) !== false ){
    header("Location: ../login.php?error=emptyinputs");
    exit();
  }
    if(InvalidUser($user) !== false && InvalidMail($user) !== false){
    header("Location: ../login.php?error=invalidUser");
    exit();
}
    if(InvalidPass($password1) !== false){
    header("Location: ../login.php?error=invalidPass");
    exit();
}

LoginUser($conn, $user, $password1);}
else { header("Location: ../login.php"); exit();}


?>