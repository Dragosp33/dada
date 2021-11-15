<?php
session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        *{ box-sizing: border-box;}
        #headerContainer {
            padding-left: 10px;
            padding-right: 10px;
            border-radius: 0 0 8px 8px;
            
            box-shadow: 5px 2px 8px #8b6409;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            background: #f4b41a;
            color: #143d59;
            margin-bottom: 20px;
            
            
        }
        #headerContainer ul {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            flex-basis: 250px;
            
        }
        

    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="headerContainer">
    <h1 id="header1"> Welcome to DPC</h1>
    <ul>
    <?php 
        echo "<li> <a href='index1.php'>Home</a></li>";
        if (isset($_SESSION["useruid"])){
            echo "<li><a href='profile.php'> Profile</a></li>";
            echo "<li> <a href='Includes/logout.inc.php'> Logout</a></li>";
        }else {

            
        echo "<li> <a href='signup.php'>Sign up!</a></li>";
        echo "<li> <a href='login.php'>Login</a></li>";}
        ?>
    </ul>
    </div>
</body>
</html>