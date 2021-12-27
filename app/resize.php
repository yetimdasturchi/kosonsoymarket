<?php

header("Content-type: image/jpeg");

function image_handler($source_image, $quality = 80, $tn_w = 750, $tn_h = 420, $wmsource = false) {

  $info = getimagesize($source_image);
  $imgtype = image_type_to_mime_type($info[2]);

  switch ($imgtype) {
  case 'image/jpeg':
  	$source = imagecreatefromjpeg($source_image);
  	break;
  case 'image/gif':
  	$source = imagecreatefromgif($source_image);
  	break;
  case 'image/png':
  	$source = imagecreatefrompng($source_image);
  	break;
  default:
  	die('Invalid image type.');
  }

  $src_w = imagesx($source);
  $src_h = imagesy($source);
  $src_ratio = $src_w/$src_h;

  if ($tn_w/$tn_h > $src_ratio) {
  $new_h = $tn_w/$src_ratio;
  $new_w = $tn_w;
  } else {
  $new_w = $tn_h*$src_ratio;
  $new_h = $tn_h;
  }
  $x_mid = $new_w/2;
  $y_mid = $new_h/2;

  $newpic = imagecreatetruecolor(round($new_w), round($new_h));
  imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
  $final = imagecreatetruecolor($tn_w, $tn_h);
  imagecopyresampled($final, $newpic, 0, 0, ($x_mid-($tn_w/2)), ($y_mid-($tn_h/2)), $tn_w, $tn_h, $tn_w, $tn_h);

  if($wmsource) {
  $info = getimagesize($wmsource);
  $imgtype = image_type_to_mime_type($info[2]);
  switch ($imgtype) {
  	case 'image/jpeg':
    	$watermark = imagecreatefromjpeg($wmsource);
    	break;
  	case 'image/gif':
    	$watermark = imagecreatefromgif($wmsource);
    	break;
  	case 'image/png':
    	$watermark = imagecreatefrompng($wmsource);
    	break;
  	default:
    	die('Invalid watermark type.');
  }

  $wm_w = imagesx($watermark);
  $wm_h = imagesy($watermark);

  $wm_x = $tn_w - $wm_w;
  $wm_y = $tn_h - $wm_h;

  imagecopy($final, $watermark, $wm_x, $wm_y, 0, 0, $tn_w, $tn_h);
  }

  $result = Imagejpeg($newpic,NULL,$quality);
  imagedestroy($result);
  return $result;

}

$image = $_GET["image"];
$quality = $_GET["quality"];
if (!isset($image)) {
	echo image_handler('http://kosonsoymarket.uz/public/images/noimage.jpg');
}else{
	if(@getimagesize($image)){
		if (isset($quality)) {
			echo image_handler($image, $quality);
		}else{
			echo image_handler($image);
		}
	}else{
    	echo image_handler('http://kosonsoymarket.uz/public/images/noimage.jpg');
	}
}

?>