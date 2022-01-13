<?php

function Show($conn, $search=null) {
    
    
    if($search !== null) {
        if(!empty($search)){
            if(filter_var($search, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s]+$/")))){
            $sql = "SELECT * FROM rss_info WHERE title like ? or oras like ? ORDER BY added DESC";
            $search = "%" . $search . "%";
            if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_id, $param_id);
            $param_id = trim($search);
           
            



           if(mysqli_stmt_execute($stmt)){
            $result_data=mysqli_stmt_get_result($stmt);
         
        
            
            
                while($row = mysqli_fetch_array($result_data)){
                        echo '<div class="container">
                        <div class="title"> ' . '<a href="view_local.php?id=' . $row['id']. '"> ' . $row['title'] . '</a>
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
            }else {$sql2 = 'SELECT * FROM rss_info ORDER BY id DESC LIMIT 20';}
        }else {$sql2 = 'SELECT * FROM rss_info ORDER BY id DESC LIMIT 20';}
    }else {$sql2 = 'SELECT * FROM rss_info ORDER BY id DESC LIMIT 20';}

    }else {$sql2 = 'SELECT * FROM rss_info ORDER BY id DESC LIMIT 20';}
}else {$sql2 = 'SELECT * FROM rss_info ORDER BY id DESC LIMIT 20';}
    if(!empty($sql2)){
    $result = mysqli_query($conn,$sql2, MYSQLI_USE_RESULT);
    while($row = $result->fetch_row()){
       /* $title=$row[1];
        $linkrow=$row[2];
        $description=$row[3];*/
      
        echo '<div class="container">
                        <div class="title">  <a href="view_local.php?id= ' . $row[0] . '" >' . $row[1] . '</a> 
                        </div>
                        <div class="img" style="background-image: url(' . $row[6]. ');">
                        </div>
                        <div class="description">
                        <div>'. $row[7] . '
                        Bucuresti
                        </div>
                        <div> ' . $row[5] . '
                       
                        </div>
                        </div>
                        </div>';
      }}

    
    


}

?>