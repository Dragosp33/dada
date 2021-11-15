<?php
include_once "Includes/header.php"; 
?>
<hmtl>
<head>
   
    <link rel="stylesheet" href="ciorna.css">
    
    <title>Profile</title>
</head>
<body>
   
<div class="bigC">
        
        <div class="A"> 
            <p> profilul tau </p>
            <div> <div style="border: 1px solid #0d1117"></div>
                    <button class="btn"  type="button" > 
                     <a href="profile.php"> Personal Data </a>
                    </button>
            </div>
            <button class="btn" type="button"> Localurile Tale </button>
            <button class="btn" type="button"> Rezervarile localurilor tale </button>
            <div>
            <div id="selected"></div><button class="btn" id ="default" type="button" > <a href="programari.php"> Rezervarile tale </a> </button>
            </div>
        </div> 
        <div class="informationcnt">
            






    <?php
    require_once "Includes/connect.php";
    if (isset($_SESSION["useruid"])){
        echo "
        <p class='info'> Welcome, " .$_SESSION["useruid"]."! </p>
        <p class='info'> Your email address is: " .$_SESSION["mail"] . "</p>";
       // $sql = 'SELECT * FROM reservation WHERE res_user = ' . $_SESSION["userID"];
        
       $sql = "SELECT title, res_date\n"

       . "FROM reservation, rss_info, users\n"
   
       . "WHERE loc_id = id AND res_user = ". $_SESSION["userID"];
        $result = mysqli_query($conn,$sql, MYSQLI_USE_RESULT);
        var_dump($result);
        while($row = $result->fetch_row()){
        echo  "
            <p class='info'> First reservation, " .$row[0]."! </p>
            <p class='info'> At the time:, " .$row[1]."! </p>";

        }
        
    }
    else { header("Location: ../index.php"); exit(); }
    
    ?>
    </div>
    </body>


</html>