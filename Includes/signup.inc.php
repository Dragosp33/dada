<?php
if(isset($_POST["submit"])) {

  //get post data
  $userL = $_POST['user'];
  $user = str_replace(" ", "", $userL);
  $email = trim($_POST['email']);
  $password1 = trim($_POST['password1']);
  $password2 = trim($_POST['password2']);
/*  $user = $_POST['user'];
  $email =$_POST['email'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2']; */
  
  require_once 'connect.php';
  require_once 'functions.inc.php';
  //This is server-side check!
  if(emptyInput($user, $email, $password1, $password2) !== false ){
    header("Location: ../signup.php?error=emptyinputs");
    exit();
  }
  if(InvalidUser($user) !== false) {
    header("Location: ../signup.php?error=invaliduser");
    exit();
  }
  if(InvalidMail($email) !== false) {
    header("Location: ../signup.php?error=invalidemail");
    exit();
  }
  if(InvalidPassword($password1, $password2) !== false) {
    header("Location: ../signup.php?error=invalidpass");
    exit();
  }
  if(UserTaken($conn, $user) !== false) {
    header("Location: ../signup.php?error=usertaken");
    exit();
  }
  if(EmailTaken($conn, $email) !== false) {
    header("Location: ../signup.php?error=emailtaken");
    exit();
  }
  CreateUser($conn, $user, $email, $password1);
  header("Location: ../signup.php?error=none&mail=".$email);

}
else { header("Location: ../signup.php"); exit();
   
}
?>