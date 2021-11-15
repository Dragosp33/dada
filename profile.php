<?php
include_once "Includes/header.php"; ?>
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
       
        
    }
    else { header("Location: ../index.php"); exit(); }
    
    ?>
    </div>
    </body>


</html>