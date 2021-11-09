<?php



function emptyInput($user, $email, $password1, $password2){

    $result;
    if( empty($user) || empty($email) || empty($password1) || empty($password2) ){
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
   /* $stmt = mysqli_stmt_init($conn);
    $sql = 'INSERT INTO users (userName, user_email, user_PWD) VALUES (?, ?, ?)';
    
    $result = mysqli_prepare($conn, $sql);
    if(!$result) { 

        header("Location: ../signup.php?error=stmt.failed");
        exit();

    }
    

    $hashed_pass = password_hash($password1, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($result, "sss", $user, $email, $password1);
    mysqli_stmt_execute($result);
    

    mysqli_stmt_close($result);*/
    $hash = md5( rand(0,1000) );
    $sql = 'INSERT INTO users (userName, user_email, user_PWD, v_hash) VALUES (?, ?, ?, ?);';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../signup.php?error=stmt.failed");
        exit();
    }
    $hashed_pass = password_hash($password1, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $user, $email, $hashed_pass, $hash);
    echo $user;
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    

    // Sending Mail 
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
				<h4><a href='http://localhost/send_mail/activate.php?uid=$user&hash=$hash'>Activate My Account</h4>
				</body>
				</html>
				";
			//dont forget to include content-type on header if your sending html
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "From: webmaster@sourcecodester.com". "\r\n" .
						"CC: ndevierte@gmail.com";
 
		mail($to,$subject,$message,$headers);
//ending of sending mail;

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
    

?>