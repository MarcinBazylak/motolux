<?php 
header('Content-Type: image/jpeg');
  $img = imagecreatefromjpeg("../photos/".$_GET['car_id']."/".$_GET['foto']); 
  $width  = imagesx($img); 
  $height = imagesy($img); 
  $ratio = $width / $height; 
  $width_mini = $width * 0.1; 
  $height_mini = $height * 0.1; 

  if($ratio>=1.5){ 
       $width_mini = 200; 
       $height_mini = 200 / $ratio; 
    }else{ 
       $width_mini = 132 * $ratio; 
       $height_mini =132; 
    } 

$img_mini = imagecreatetruecolor($width_mini, $height_mini); 
imagecopyresampled($img_mini, $img, 0, 0, 0, 0, $width_mini , $height_mini, $width  , $height); 

imagejpeg($img_mini, NULL, 75);
imagedestroy($img); 
imagedestroy($img_mini); 

?> 




