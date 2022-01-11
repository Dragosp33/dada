<?php
require_once __DIR__ . '/vendor/autoload.php';



?>
    
<?php 
$image = new Imagick('database_scheme.PNG');
$fake = 'uploads/sall.PNG';
$width = $image->getImageWidth();
$height = $image->getImageHeight();
  $image->thumbnailImage($width, $height, TRUE);
  $image->writeImage($fake);
  $image->destroy();
 ?> 