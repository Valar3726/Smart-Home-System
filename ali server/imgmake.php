<?php
header("Content-type: image/png");


$tem = 33;

$dst = "4.png";


$dst_im = imagecreatefrompng($dst);
$dst_info = getimagesize($dst);


$src = "2.png";
$src_im = imagecreatefrompng($src);
$src_info = getimagesize($src);


$alpha = 100;
$out_1 = $tem*2.5;
$out_2 = 156-$out_1;

imagecopymerge($dst_im,$src_im,72,$out_2,0,0,13,$out_1,$alpha);


imagepng($dst_im,'1.png');
imagedestroy($dst_im);
imagedestroy($src_im);
?>
