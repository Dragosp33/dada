<?php
    include_once "Includes/header.php";
    require_once "Includes/connect.php";
    require_once "Includes/views.php";
   
    $page_id = 1;
    $visitor_ip = $_SERVER['REMOTE_ADDR'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    
    add_view($conn, $visitor_ip, $page_id, $browser);
    /*
    $host = 'localhost';
    $db   = 'dpc';
    $uname = 'root';
    $pass = '22222';
    $charset = 'utf8';*/
    
?>
<?php /*
<html> 
    <head> 
        <link rel="stylesheet" href="index.css"> 
    </head>
    <body> 
    <form action="index1.php" method="GET">
        <input type="text" placeholder="Search.." name="search">
        <button type="submit">Submit</button>
</form> 
        <section class="flex-index">
        

 
<?php
//$conn = mysqli_connect($host, $uname, $pass, $db);
if(isset($_GET["search"])){
    $Name = $_GET["search"];
    if($Name !== ""){
    $Name = "%".$Name."%";
    $sql = "SELECT * FROM rss_info WHERE title like ?  ORDER BY id DESC LIMIT 20";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) { 

        header("Location: index1.php");
        exit();

    }
    mysqli_stmt_bind_param( $stmt, "s", $Name);
    mysqli_stmt_execute($stmt);
    $result_data=mysqli_stmt_get_result($stmt);
 

    while($row = mysqli_fetch_assoc($result_data)){
        $title=$row["title"];
        $linkrow=$row["link"];
        $description=$row["description"];
      
        echo "
        <item class='flex-container'>
        <p>$title</p>
        <p> <a href='$linkrow'> $linkrow</a></p>
        <description>$description</description>
       
        </item>";
      }
}else {
	
    $sql2 = 'SELECT * FROM rss_info ORDER BY id DESC LIMIT 20';}}
else {
	
    $sql2 = 'SELECT * FROM rss_info ORDER BY id DESC LIMIT 20';}
    if(!empty($sql2)){
    $result = mysqli_query($conn,$sql2, MYSQLI_USE_RESULT);
    while($row = $result->fetch_row()){
        $title=$row[1];
        $linkrow=$row[2];
        $description=$row[3];
      
        echo "
        <item class='flex-container'>
        <p>$title</p>
        <p> <a href='$linkrow'> $linkrow</a></p>
        <description>$description</description>
       
        </item>";
      }}
?>

</section> 
    </body> 

</html>    


<html>
    <a href="/signup.php">Sign Up</a>
</html>
*/?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/3922829833.js" crossorigin="anonymous"></script>
    <title>jsfiddle</title>
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
</head>
<body>
    <section>

        <div class="inputbox">
        <form class="search" action="index1.php" method="GET">
        
        <div>
        <i class="fas fa-search"></i>
        
        <input name="search" value="">
        </div>
        <button class="btnsearch" type="submit">
        search
        </button>
        </div>
        
        </div>

    </h1>
    <div class="grid">


<?php
require "Includes/view.inc.php";
if(isset($_GET['search'])) {
  $search = trim($_GET['search']);
  Show($conn, $search);
}else {
  Show($conn);
}
?>

</div>                
</section>               
</body>
</html>

<?php
Include_once "Includes/footer.php";
?>