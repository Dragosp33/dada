<?php
include_once "Includes/header.php"; 
require_once "Includes/connect.php";
require_once "Includes/views.php";
   
    $page_id = 4;
    $visitor_ip = $_SERVER['REMOTE_ADDR'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    
    add_view($conn, $visitor_ip, $page_id, $browser);
?>
<hmtl>
<head>
   
    <link rel="stylesheet" href="ciorna.css">
    <script src="ciorna.js"></script>
    <title>Profile</title>
</head>
<body>
   
<div class="bigC">
        
        <div class="A"> 
            <p> profilul tau </p>
            <div> <div id="selected"></div>
                    <button class="btn" id ="default" type="button" style="background-color: #2d333b">
                     <a href="profile.php"> Personal Data </a>
                    </button>
            </div>
            <button class="btn" type="button"> Localurile Tale </button>
            <button class="btn" type="button"> Rezervarile localurilor tale </button>
            <button class="btn" type="button" > <a href="programari.php"> Rezervarile tale </a> </button>
       
        </div> 
        <div class="informationcnt">
            






        <?php
    if (isset($_SESSION["useruid"])){
        echo "
        <p class='info'> Welcome, " .$_SESSION["useruid"]."! </p>
        <p class='info'> Your email address is: " .$_SESSION["mail"] . "</p>";
       if (isset($_SESSION["role"])) {
           echo "<a href='admin.php'> Vezi pagina de admin </a>";
       }
        
    }
    else { header("Location: ../index1.php"); exit(); }
    
    ?>
    </div>
    </body>


</html>