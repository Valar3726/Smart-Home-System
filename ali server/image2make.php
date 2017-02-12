<?php
header("Content-type: image/png");


$tem = 33;

$dst = "w1.png";


$dst_im = imagecreatefrompng($dst);
$dst_info = getimagesize($dst);


$src = "w2.png";
$src_im = imagecreatefrompng($src);
$src_info = getimagesize($src);


$alpha = 100;
$out_1 = $tem*1.25;
$out_2 = 181-$out_1;

imagecopymerge($dst_im,$src_im,72,$out_2,0,0,13,$out_1,$alpha);


imagepng($dst_im,'w4.png');
imagedestroy($dst_im);
imagedestroy($src_im);

?>
