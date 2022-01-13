<?php
require_once "Includes/connect.php";
Include_once "Includes/header.php";

if(isset($_GET["id"])){
    $x = trim($_GET["id"]);
    $sql = "SELECT * FROM rss_info WHERE id = ?";
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $x;
        if(mysqli_stmt_execute($stmt)){
            $result_data=mysqli_stmt_get_result($stmt);
         
        
            
            
                while($row = mysqli_fetch_array($result_data)){
                        echo '<div class="container">
                        <div class="title"> ' . '<a href="view_local.php?id= ' . $row['id'] . '>' . $row['title'] . '</a>
                        </div>
                        <div class="img" style="background-image: url(' . $row['thumbnail']. ');">
                        </div>
                        <div class="description">
                        <div>'. $row['oras'] . '
                        
                        </div>
                        <div> ' . $row['added'] . '
                       
                        </div>
                        </div>
                        </div>';

                }

}}
}

?>