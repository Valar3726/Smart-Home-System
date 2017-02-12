<?php
error_reporting(E_ALL);
set_time_limit(0);
echo "<h2>TCP/IP Connection</h2>\n";

$port = 10087;
$ip = "139.129.7.4";



$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket < 0) {
  echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
}else {
  echo "OK.\n";
}
$result = socket_connect($socket, $ip, $port);
if ($result < 0) {
  echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
}else {
  echo "连接OK\n";
}

$in = 'hello';
$out = '';

if(!socket_write($socket, $in, strlen($in))) {
  echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
}else {
  echo "发送到服务器信息成功！\n";
}

while(1)
{
        $out = socket_read($socket,8192);
        if($out == 1)
        {
                $filename = 'data.txt';
                system("python data.py");
                while(1)
                {
                        if(file_exists($filename))
                        break;
                }
                $in = file_get_contents($filename);
                unlink($filename);
                $array = explode("\r\n",$in);
                $in = $array[5];
                socket_write($socket,$in,strlen($in));
        }
        else if($out == 6)
        {
                $filename = 'data.txt';
                system("python data.py");
                while(1)
                {
                        if(file_exists($filename))
                        break;
                }
                $in = file_get_contents($filename);
                unlink($filename);
                $array = explode("\r\n",$in);
                $in = $array[6]."\n".$array[7]."\n".$array[8];
                socket_write($socket,$in,strlen($in));
        }
        else if($out == 2)
                {
                        $filename = 'data.txt';
                        system("python data.py");
                        while(1)
                        {
                                if(file_exists($filename))
                                break;
                        }
                        $in = file_get_contents($filename);
                        unlink($filename);
                        $array = explode("\r\n",$in);
                        $in = $array[11];
                        socket_write($socket,$in,strlen($in));
                }
                else if($out == 3)
                {
                        $filename = 'data.txt';
                        system("python data.py");
                        while(1)
                        {
                                if(file_exists($filename))
                                break;
                        }
                        $in = file_get_contents($filename);
                        unlink($filename);
                        $array = explode("\r\n",$in);
                        $in = $array[12];
                        socket_write($socket,$in,strlen($in));
                }
                else if($out == 4)
       {
               system("python write.py");

               $in = "LED already open";
               socket_write($socket,$in,strlen($in));
       }
       else if($out == 5)
       {
               system("python write_1.py");

               $in = "LED already closed";
               socket_write($socket,$in,strlen($in));
       }
}


echo "关闭SOCKET...\n";
socket_close($socket);
echo "关闭OK\n";
?>
