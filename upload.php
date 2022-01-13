<?php
require_once "Includes/connect.php";
Include_once "Includes/header.php";
require_once __DIR__ . '/vendor/autoload.php';
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
$url = 'https://heroevent.s3.eu-west-3.amazonaws.com/';
$acceskey = getenv('AWS_ACCESS_KEY_ID'); $secret = getenv('AWS_SECRET_ACCESS_KEY');
$s3 = new Aws\S3\S3Client([
    'version'  => '2006-03-01',
    'region'   => 'eu-west-3',
    'credentials' => [
        'key'    => $acceskey,
        'secret' => $secret,
    ]
]);
$bucket = getenv('S3_BUCKET');


if(!isset($_SESSION['useruid'])) {
  header("Location: ../index1.php");
  exit();
}

   
require_once "Includes/views.php";
   
$page_id = 5;
$visitor_ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];

add_view($conn, $visitor_ip, $page_id, $browser);



?>
<html>
<head>
<title> Upload Event</title>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script>
  $(document).ready(function () {
  ImgUpload();
});

function ImgUpload() {
  
  var imgWrap = "";
  var imgArray = [];

  $('.upload__inputfile').each(function () {
    $(this).on('change', function (e) {
      imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      var maxLength = $(this).attr('data-max_length');

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      var iterator = 0;
      filesArr.forEach(function (f, index) {

        if (!f.type.match('image.*')) {
          return;
        }

        if (imgArray.length > maxLength) {
          return false
        } else {
          var len = 0;
          for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i] !== undefined) {
              len++;
            }
          }
          if (len > maxLength) {
            return false;
          } else {
            imgArray.push(f);

            var reader = new FileReader();
            reader.onload = function (e) {
              var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'>XX</div></div></div>";
              imgWrap.append(html);
              iterator++;
            }
            reader.readAsDataURL(f);
          }
        }
      });
    });
  });
  window.NewFileList = [];
  $('body').on('click', ".upload__img-close", function (e) {
    var file = $(this).parent().data("file");
    for (var i = 0; i < imgArray.length; i++) {
      if (imgArray[i].name === file) {
        imgArray.splice(i, 1);
        break;
      }
    }
    $(this).parent().parent().remove();
    window.NewFileList.push(file);
    document.getElementById('removed_files').value = JSON.stringify(window.NewFileList);
  });

}
/*
window.Thumbnail = '';
$('body').on('click', ".thumb", function (e){
   var file = $(this).parent().data("file");
  window.thumbnail = file;
  document.getElementById('thumbnail').value = JSON.stringify(thumbnail);
});
*/
  </script>
  <link rel="stylesheet" href="upload.css">
</head>
<body>
<form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
  <div>
  <input type="text" name="local" id="local" placeholder="Cum se numeste localul?">
  </div>
  <div>
  <input type="text" name="oras" id="local" placeholder="In ce oras este localul tau?">
  </div>
  <textarea name = "description" id="local" placeholder="Descrie-ne localul in cateva cuvinte!"></textarea>

  <div id="Gallery">
    <h1> Complete this with some descriptive photos of your place </h1>
  <div class="upload__box">
    <div class="upload__btn-box">
      <label class="upload__btn">
        <p>Upload images</p>
        <input type="file" name="files[]" multiple="" data-max_length="20" class="upload__inputfile">
        
      </label>
      
    </div>
    <div class="upload__img-wrap"></div>
  </div>
</div>
<input type="submit" name="submit" value="UPLOAD">
    <input type="hidden" name="removed_files" id="removed_files" value="" />
  
    
    
</form>
</body>
</html>
<?php

if(isset($_POST['submit'])){ 
  
  $title = $_POST['local'];
  $title1 = trim($title);
  $oras = trim($_POST['oras']);
  $oras1 = trim($oras);
  
  $description = $_POST['description'];
  $description1 = trim($_POST['description']);
  if(empty($title1) || strlen($title1) > 20){ echo "Numele localului trebuie sa aiba intre 0 si 20 caractere."; exit();}
  
  elseif(strlen($description1) < 10 || strlen($description) > 200){ echo "Introdu intre 10 si 200 de caractere pentru descriere"; exit();}
  elseif(empty($oras1) || strlen($oras1) > 20) { echo "orasul trebuie sa aiba intre 0 si 20 de caractere!"; exit();}
  else {

    





    // File upload configuration 
    $removed_files = json_decode($_POST['removed_files'], true);
    
    
    $targetDir = "uploads/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    echo $statusMsg;
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
      $sql = "INSERT INTO rss_info (title, description, proprietar_id, oras) VALUES (?, ?, ?, ?)";
         
      if($stmt = mysqli_prepare($conn, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "ssis", $param_name, $param_desc, $param_prop, $param_oras);
          
          // Set parameters
          $param_name = $title;
          $param_desc = $description;
          $param_prop = $_SESSION["userID"];
          $param_oras= $oras;
          
          // Attempt to execute the prepared statement
          mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);
          
          }
  
  
  
      
      
  
      $local_id = 0;
          $sql2 = "SELECT id FROM rss_info where proprietar_id = ". $param_prop . " ORDER BY id DESC LIMIT 1 " ; /*. " AND title = " . $param_name;*/
          if($result = mysqli_query($conn, $sql2, MYSQLI_USE_RESULT)){
          while($row = $result->fetch_row()){ $local_id = $row[0];
          }
        
        
        }else echo "No result found";
        $fake = '';
        $url3 = ''; $count = 0;
        foreach($_FILES['files']['name'] as $key=>$val){ 
          
          if(!empty($removed_files) && in_array($_FILES['files']['name'][$key], $removed_files)) {
            continue;
          }
            
            // File upload path 
           
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
            
            
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            
            
            
           
           
            if(in_array(strtolower($fileType), $allowTypes)){
              $s3_key = md5(rand(0, 5000));
             

              $targetFilePath2 = "uploads/" . $s3_key . "." .$fileType;
              
              if(getimagesize($_FILES["files"]["tmp_name"][$key]) !== false){
                $image = new Imagick($_FILES["files"]["tmp_name"][$key]);
                $width = $image->getImageWidth();
                $height = $image->getImageHeight();
                if($width < 2000 && $height < 2000) {
                  $image->thumbnailImage($width, $height, TRUE);
                  $image->writeImage($targetFilePath2);

                  $result = $s3->putObject([
                    'Bucket' => $bucket,
                    'Key' => $s3_key,
                    'Body' => fopen($targetFilePath2, "r")
                  ]);
                  
                  $url2 = $url . $s3_key;
                  $image->destroy();
                  $count = $count+1;
                  if($count == 1){
                    $url3 = $url2;
                  }
                  
                  
                  $insertValuesSQL .= "('" . $url2. "', NOW(), '" .  $local_id . "'),";
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                    echo "eroare la width/height ".$errorUpload;}
                }
                else{ 
                  $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                  echo "eroare la getimagesize ".$errorUpload;}
            }else{ 
                echo "eroare la extensie";
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
            //unlink($targetFilePath);
        } 
            $sql = "UPDATE rss_info SET thumbnail=? WHERE ID=?";
             
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "si", $param_name, $param_id);
                
                // Set parameters
                $param_name = $url3;
                
                $param_id = $local_id;

                
                
                
                // Attempt to execute the prepared statement
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);}

         
        // Error message 
        $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
        $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
        $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
         
        if(!empty($insertValuesSQL)){ 
          $insertValuesSQL = trim($insertValuesSQL, ",");
          
          
           
            // Insert image file name into database 
            $insert = $db2->query("INSERT INTO images (filepath, data_add, rss_id) VALUES $insertValuesSQL"); 
           
            
            
            if($insert){ 
                $statusMsg = "Files are uploaded successfully.".$errorMsg; 
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file.";  
                
            }

        }else{ 
            $statusMsg = "Upload failed! ".$errorMsg; 
        } 
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
    
    
    
} $_POST = array();}
echo $statusMsg;
?>