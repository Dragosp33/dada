<?php
    include_once "Includes/header.php";
    require_once "Includes/connect.php";
    /*
    $host = 'localhost';
    $db   = 'dpc';
    $uname = 'root';
    $pass = '22222';
    $charset = 'utf8';*/
    
?>

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

<?php
    include_once "Includes/footer.php";
    ?>