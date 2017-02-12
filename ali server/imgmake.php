<?php
header("Content-type: image/png");


$tem = 33;
//原始图像
$dst = "4.png";

//得到原始图片信息
$dst_im = imagecreatefrompng($dst);
$dst_info = getimagesize($dst);

//水印图像
$src = "2.png";
$src_im = imagecreatefrompng($src);
$src_info = getimagesize($src);

//水印透明度
$alpha = 100;
$out_1 = $tem*2.5;
$out_2 = 156-$out_1;
//合并水印图片
imagecopymerge($dst_im,$src_im,72,$out_2,0,0,13,$out_1,$alpha);

//输出合并后水印图片
imagepng($dst_im,'1.png');
imagedestroy($dst_im);
imagedestroy($src_im);
?>
