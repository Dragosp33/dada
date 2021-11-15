<?php
    /*
    $host = 'localhost';
    $db   = 'dpc';
    $uname = 'root';
    $pass = '22222';
    $charset = 'utf8';
	
	$conn = mysqli_connect($host, $uname, $pass, $db);
    $db2 = new mysqli($host, $uname, $pass, $db);*/

$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);


    /*
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$db = mysqli_select_db($link, "mysql" );

if($db){
if ($result = $link->query("SELECT DATABASE()")) {
    $row = $result->fetch_row();
    printf("Default database is %s.\n", $row[0]);
    $result->close();
}
}
if ($result = mysqli_query($link, "SELECT User FROM user", MYSQLI_USE_RESULT)) {
	$i = 0;
   while ($row = $result->fetch_row()){ 
											$user_arr[] = $row; ; 
										printf("user %s. \n", $i); echo $row[0];
$i = $i+1;}
   

    /* free result set 
    mysqli_free_result($result);}


else {echo "data de baze nu exista!";}

mysqli_close($link);*/
	
	
	
?>