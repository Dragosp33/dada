<?php
require 'vendor/autoload.php';
use PHPmailer\PHPmailer\PHPmailer;

function emptyInput($user, $email, $password1, $password2){

    $result;
    if( empty($user) || empty($email) || empty($password1) || empty($password2) ){
        $result = true;
    }else{$result=false;}
    return $result;
}
function emptyInput2($user, $password1){

    $result;
    if( empty($user) || empty($password1)  ){
        $result = true;
    }else{$result=false;}
    return $result;
}


function InvalidUser($user){
    $result; 
    if(strlen($user) > 15 || strlen($user) < 3) {
        $result = true;
    }
   // if(!preg_match("/^[a-zA-Z0-9]$*/", $user)){
   //     $result = true;
   // }
    else {$result = false;}
    return $result;
}
function InvalidMail($mail){
    $result; 
    if(strlen($mail) < 3) {$result = true;}
    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {$result = true;}
    else { $result = false;}
    return $result;
}

function InvalidPassword($password1, $password2) {
    if(strlen($password1) < 4 || strlen($password1) > 25) {$result = true;}
    if($password1 !== $password2) { $result = true;}
    else { $result = false;}
    return $result;
}

function InvalidPass($password1) { 
    if(strlen($password1) < 4 || strlen($password1) > 25) {$result = true;}
    else { $result = false;}
    return $result;
}

function UserTaken($conn, $user) {
    $sql = 'SELECT * FROM users WHERE userName = ?;';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) { 

        header("Location: ../signup.php?error=stmt.failed");
        exit();

    }
    
    mysqli_stmt_bind_param( $stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result_data=mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result_data)){
        return $row;
    }else {$result = false; return $result; }

    mysqli_stmt_close($stmt);

}

function EmailTaken($conn, $email) {
    $sql = 'SELECT * FROM users WHERE user_email = ?;';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) { 

        header("Location: ../signup.php?error=stmt.failed");
        exit();

    }
    
    mysqli_stmt_bind_param( $stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result_data=mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result_data)){
        return $row;
    }else {$result = false; return $result; }

    mysqli_stmt_close($stmt);

}



function CreateUser($conn, $user, $email, $password1) {
   
    $hash1 = md5( rand(0,1000) );
    $sql = 'INSERT INTO users (userName, user_email, user_PWD, v_hash) VALUES (?, ?, ?, ?);';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../signup.php?error=stmt.failed");
        exit();
    }
    $hashed_pass = password_hash($password1, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $user, $email, $hashed_pass, $hash1);
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    

    // Sending Mail 
    
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username = 'dragosp0201@gmail.com';
    $mail->Password = 'Z1poliCT';
    $mail->SMTPAuth = true;
    $mail->setFrom('dragosp0201@gmail.com', 'Gmail');
    $mail->addAddress($email, 'Tim');
    $mail->Subject = 'Test Email via Mailtrap SMTP using PHPMailer';
    $mail->isHTML(true);
			$message = "
				<html>
				<head>
				<title>Verification Code</title>
				</head>
				<body>
				<h2>Thank you for Registering.</h2>
				<p>Your Account:</p>
				<p>Email: ".$email."</p>
				<p>Password: ".$password1."</p>
				<p>Please click the link below to activate your account.</p>
				<h4><a href='http://localhost/activate.php?uid=$user&hash=$hash1'>Activate My Account</h4>
				</body>
				</html>
				";
			//dont forget to include content-type on header if your sending html
		/*	$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "From: webmaster@sourcecodester.com". "\r\n" .
						"CC: ndevierte@gmail.com";*/
    $mail->Body = $message;
    $mail->send();
          /*  if(){
                echo 'Message has been sent';
            }else{
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }*/
    header("Location: ../signup.php?error=none&mail=$email"); 
}
/*
function SendMail($conn, $email, $password){
    $hash = md5( rand(0,1000) );
  $to = $email;
			$subject = "Sign Up Verification Code";
			$message = "
				<html>
				<head>
				<title>Verification Code</title>
				</head>
				<body>
				<h2>Thank you for Registering.</h2>
				<p>Your Account:</p>
				<p>Email: ".$email."</p>
				<p>Password: ".$password."</p>
				<p>Please click the link below to activate your account.</p>
				<h4><a href='http://localhost/send_mail/activate.php?uid=$uid&hash=$hash'>Activate My Account</h4>
				</body>
				</html>
				";
			//dont forget to include content-type on header if your sending html
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "From: webmaster@sourcecodester.com". "\r\n" .
						"CC: ndevierte@gmail.com";
 
		mail($to,$subject,$message,$headers);

}

*/

/// Login function:
function UserExists($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE userName = ? OR user_email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) { 

        header("Location: ../login.php?error=stmt.failed");
        exit();

    }
    
    mysqli_stmt_bind_param( $stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    $result_data=mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result_data)){
        return $row;
    }else {$result = false; return $result; }

    mysqli_stmt_close($stmt);
}


function LoginUser($conn, $user, $password1) {
    $uidExists = UserExists($conn, $user, $user);

    if ($uidExists === false) {
        header("Location: ../login.php?error=wrong-login");
        exit();

    }
    $verified = $uidExists['verified'];
    echo $verified;
    
    if($verified === 0){
        header("Location: ../login.php?error=verify");
        exit();
    }

    $pwdHashed = $uidExists['user_PWD'];
    
    $checkPwd = password_verify($password1, $pwdHashed);
    
    if($checkPwd === false) {
        header("Location: ../login.php?error=wrong-login");
        exit();
    }
    else if ($checkPwd === true) {
        
        
        session_start();
        $_SESSION["userID"] = $uidExists["userID"];
        $_SESSION["useruid"] = $uidExists["userName"];
        $_SESSION["mail"] = $uidExists["user_email"];
        header("Location: ../index.php");
        exit();
    }
}
    

?>