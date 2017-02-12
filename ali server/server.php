<?php

set_time_limit(0);

$ip = '139.129.7.4';
$port = 10087;


if(($sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP)) < 0) {
  echo "socket_create() 失败的原因是:".socket_strerror($sock)."\n";
}

if(($ret = socket_bind($sock,$ip,$port)) < 0) {
  echo "socket_bind() 失败的原因是:".socket_strerror($ret)."\n";
}

if(($ret = socket_listen($sock,4)) < 0) {
  echo "socket_listen() 失败的原因是:".socket_strerror($ret)."\n";
}

$count = 0;

while(1)
{
        if (($msgsock = socket_accept($sock)) < 0)
        {
        echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
        }
        else
        {
                echo "连接成功\n";
                break;
        }
}

while(1)
{
        $filename = 'data.txt';
        while(1)
        {
            if(file_exists($filename))
            {
                break;
            }
        }

        $msg = file_get_contents($filename);

        unlink($filename);


        socket_write($msgsock, $msg, strlen($msg));

        echo "数据已发送\n";

        while(1)
        {
                $buf = socket_read($msgsock,8192);
                if($buf!="hello")
                {
                        break;
                }
        }
        $talkback = "收到的信息:$buf\n";
        echo $talkback;


        file_put_contents('receive.txt',$buf);
}



socket_close($sock);
?>
