<?php
require_once 'Includes/connect.php';
if(isset($_GET["hash"])){
    $hash2 = $_GET["hash"];
    $usernm = $_GET["uid"];
    $sql2 = 'SELECT v_hash FROM users where userName = ?';
    $sql = 'UPDATE users SET verified = 1 WHERE userName = ?';
    $stmt2 = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt2, $sql2)) { 

        header("Location: ../signup.php?error=stmt.failed");
        exit();

    }
    mysqli_stmt_bind_param( $stmt2, "s", $usernm);
    mysqli_stmt_execute($stmt2);
    
    $result_data=mysqli_stmt_get_result($stmt2);
    $row = $result_data->fetch_row();
    if( $row[0] !== $hash2){header("Location: ../signup.php?error=stmt.failed");
        exit();}
    else {echo "good hash!";}
    mysqli_stmt_close($stmt2);
    mysqli_free_result($result_data);
   // $sql = "UPDATE users SET verified = 1 WHERE"
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) { 

        header("Location: ../signup.php?error=stmt.failed");
        exit();

    }
    
    mysqli_stmt_bind_param( $stmt, "s", $usernm);
    mysqli_stmt_execute($stmt);
    echo "Success verification! <br> You can log in now!";

}

?>