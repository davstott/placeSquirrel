<?php
  // requires GD
  // requires allow_url_fopen in INI

  // parse squirrels.js
  $squirrels = file_get_contents('./squirrels.json');
  $squirrels = json_decode($squirrels, true);
  // width must be defined
  $width = intval($_GET['width']);
  // height should be worked out if not specified
  // todo: this
  $height = intval($_GET['height']);
  // image can be
  if (isset($_GET['image'], $squirrels[$_GET['image']])) {
    $squirrel = $squirrels[$_GET['image']];
  } else { 
    $i = rand(0, count($squirrels));
    // todo: this better
    $j = 0;
    foreach ($squirrels as $tmp => $squirrel) {
      if ($i == $j) { 
        break;
      }
      $j++;
    }
  }
  //var_dump($squirrel); 
  //todo: pick an image source url closest to the requested size and aspect ratio
  //todo: consider cropping if aspect ratio is beyond x% of original
  //todo: fix this. two get requests when none is the correct number?
  $srcImage = imagecreatefromjpeg($squirrel['url']);
  list($srcWidth, $srcHeight) = getimagesize($squirrel['url']);
 
  $newImage = imagecreatetruecolor($width, $height);
  imagecopyresampled($newImage, $srcImage, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);
   
  header('Content-Disposition:inline; filename=squirrel_' . $width . '_' . $height . '.jpg');
  header('Content-type: image/jpeg');
  header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($url)) . ' GMT');
  imagejpeg($newImage);
  imagedestroy($newImage);
  imagedestroy($srcImage);

?>
