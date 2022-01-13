<html>
    <head>
    <title>local </title>
    <link rel="stylesheet" href="upload.css"></head>
    <style>
            
        *{
  box-sizing: border-box;
}

section {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.inputbox{
  margin-bottom: 4vh;
}
input {
  width: 200px;
  border-radius: 4px;
  padding: 3px;
  font-size: min(2.5vw, 3.5vh);
  border: none;
}
input:focus {
  outline:none;
}
input:active{
  outline: none;
}
.search{
  padding-left: 3px;
  padding-right: 3px;
  border: 2px solid grey;
  border-radius: 3px;
  display: flex; flex-direction: row;
}
.fas.fa-search{
  font-size: min(2.5vw, 3.5vh);
}


.btnsearch{
  border: none;
  cursor: pointer;
}



.grid {
  display: grid;
  width: 84.5vw;
  grid-template-columns: repeat(4, auto);
  row-gap: 3%;
  column-gap: 1.5%;
  border: 2px solid;
  padding: 0.3vw;
  padding-bottom: 5%;
  background-color:#f5f5f5
 
}

.container{
  padding: 1vw;
  display: flex;
 flex-direction: column;
  width: 20vw;
  border: 2px solid lightgray;
 background-color: white;
 border-radius: 2%;
}
.title {
  font-size: min(1.6vw, 5vh);
}

.img {
  display: inline-block;
  width: 100%;
  height: 10vh;
  background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    position: relative;
    padding-bottom: 100%;
}

.description {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
   font-size: min(2vw, 2vh);
 
}
        </style>
    </html>
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
                        <div class="title"> <a href="view_local.php?id= ' . $row['id'] . '>' . $row['title'] . '</a>
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