<?php
//This page created captcha image with 4-6 random digits


session_start();
$code=rand(1000,999999);
$_SESSION["code"]=$code;
$im = imagecreatetruecolor(80, 40);
$bg = imagecolorallocate($im, 102, 102, 102); //background color gray
$fg = imagecolorallocate($im, 51, 204, 51);//text color green
imagefill($im, 0, 0, $bg);
imagestring($im, 5, 13, 13,  $code, $fg);
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
?>