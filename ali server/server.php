<?php
//确保在连接客户端时不会超时
set_time_limit(0);

$ip = '139.129.7.4';
$port = 10087;

/*
 +-------------------------------
 *  @socket通信整个过程
 +-------------------------------
 *  @socket_create
 *  @socket_bind
 *  @socket_listen
 *  @socket_accept
 *  @socket_read
 *  @socket_write
 *  @socket_close
 +--------------------------------
 */

/*----------------  以下操作都是手册上的  -------------------*/
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
//发到客户端
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
 //echo $buf;
    // socket_close($msgsock);


socket_close($sock);
?>
