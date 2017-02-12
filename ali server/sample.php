<?php include "text.php" ?>
<?php
header("Content-type: image/png");
header("Pragma:   no-cache");
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
  $wechatObj = new weixinapi();
  $postObj = $wechatObj->getHttp();
  $fromUsername = $postObj->FromUserName;
  $toUsername = $postObj->ToUserName;
  $keyword = trim($postObj->Content);
  $MsgType = $postObj->MsgType;
  $filename_1 = 'data.txt';
  $filename_2 = 'receive.txt';
  if($keyword=="湿度")
  {
          if(file_exists('w5.png'))
          {
                  unlink('w5.png');
          }
          $r_content = "1";
          file_put_contents($filename_1,$r_content);
          while(1)
          {
                  if(file_exists($filename_2))
                  break;
          }
          $content = file_get_contents($filename_2);
          unlink($filename_2);
          $dst = "w1.png";
          $tem =  floatval($content);

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
          sleep(1);

          $filename = 'w4.png';
          $percent = 5;
          list($width, $height) = getimagesize($filename);
          $newwidth = $width * $percent;
          $newheight = $height;

          $thumb = imagecreatetruecolor($newwidth, $newheight);

          $source = imagecreatefrompng($filename);

          imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth,$newheight, $width, $height);

          imagejpeg($thumb,'w5.png');
          unlink('w4.png');
          sleep(1.5);
          $wechatObj->retImgTex("当前湿度",1,"当前湿度为：".$content,'http://139.129.7.4/w5.png','http://139.129.7.4/w5.png',$postObj);

  }
  else if($keyword=="温度")
  {
          if(file_exists('5.png'))
          {
                  unlink('5.png');
          }
          $r_content = "6";
          file_put_contents($filename_1,$r_content);
          while(1)
          {
                  if(file_exists($filename_2))
                  break;
          }
          $content = file_get_contents($filename_2);
          unlink($filename_2);
          $dst = "4.png";
          $tem =  floatval($content);

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
          sleep(1);

          $filename = '1.png';
          $percent = 5;
          list($width, $height) = getimagesize($filename);
          $newwidth = $width * $percent;
          $newheight = $height;

          $thumb = imagecreatetruecolor($newwidth, $newheight);

          $source = imagecreatefrompng($filename);

          imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth,$newheight, $width, $height);

          imagejpeg($thumb,'5.png');
          unlink('1.png');
          sleep(1.5);
          $wechatObj->retImgTex("当前温度",1,"当前温度为：".$content."℃",'http://139.129.7.4/5.png','http://139.129.7.4/5.png',$postObj);
  }
  else if($keyword=="光度")
{
        $r_content = "2";
        file_put_contents($filename_1,$r_content);
        while(1)
        {
                if(file_exists($filename_2))
                break;
        }
        $content = file_get_contents($filename_2);
        unlink($filename_2);
        $wechatObj->retText("光度为:".$content."lx",$postObj);

}
else if($keyword=="LED状态")
{
        $r_content = "3";
        file_put_contents($filename_1,$r_content);
        while(1)
        {
                if(file_exists($filename_2))
                break;
        }
        $content = file_get_contents($filename_2);
        unlink($filename_2);
        $wechatObj->retText($content,$postObj);
}
else if($keyword=="打开LED")
{
        $r_content = "4";
        file_put_contents($filename_1,$r_content);
        while(1)
        {
                if(file_exists($filename_2))
                break;
        }
        $content = file_get_contents($filename_2);
        unlink($filename_2);
        $wechatObj->retText($content,$postObj);
}
else if($keyword=="关闭LED")
{
        $r_content = "5";
        file_put_contents($filename_1,$r_content);
        while(1)
        {
                if(file_exists($filename_2))
                break;
        }
        $content = file_get_contents($filename_2);
        unlink($filename_2);
        $wechatObj->retText($content,$postObj);
}
else
{
        $content = "欢迎使用智能家居管理系统，分别输入湿";
        $content1 = "度、温度、光度、LED状态可分别获取当前温度、湿、光度和LED的开关情况，输入打开LED则可打开LED灯，反之输入关闭LED则可以关闭LED灯";
        $wechatObj->retText($content,$postObj);
}
?>
