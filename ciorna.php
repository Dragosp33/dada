<?php
include_once "Includes/header.php"; 
include_once "Includes/connect.php"; ?>
<html lang="en">
<head>
   
    <link rel="stylesheet" href="ciorna.css">
    <script src="ciorna.js"></script>
    <title>Document</title>
</head>
<body>
   
<div class="bigC">
        
        <div class="A"> 
            <p> profilul tau </p>
            <div> <div id="selected"></div><button class="btn" id ="default" type="button" onclick=Show(1)> personal data </button>
            </div>
            <button class="btn" type="button" onclick=Show(2)> Localurile Tale </button>
            <button class="btn" type="button" onclick="Show(3)"> Rezervarile localurilor tale </button>
            <button class="btn" type="button" onclick="Show(4)"> Rezervarile tale </button>
       
        </div> 
        <div class="informationcnt">
            <div class="info" id="personal"> 
            <button class="btn" id="add" type="button"> <div>+</div>
            <a href="index.php" target="_blank" id="add"> Adauga rezervare </a></button> 
                <p> esti un ratat </p>
                <p> muie </p>
                <h1> sall </h1>  
                <h1>  Rem autemmque quaerat magnam dicta quod minus sint, ad accusamus </h1> 
                
                    
            </div>
            <p class="info" id="lista1"> honolulu unde iti dau la muie ca nebunu </p>
            <p class="info" id="rezervari1"> azi sunt flamer </p>
            <p class="info" id="rezervari2"> ai programare la fix sa mi sugi pula </p>
        </div>


</div>





</form>
</body>
</html>