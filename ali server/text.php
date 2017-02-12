<?php
class weixinapi
{

    public function getHttp(){
          $postStr =   isset($GLOBALS["HTTP_RAW_POST_DATA"]) ?  $GLOBALS["HTTP_RAW_POST_DATA"]  : "" ;
        $t =  strlen($postObj->MsgType) ;
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        return $postObj;
    }


    public function retText($t, $postObj){
          $msgType =  "text";
        $time = time($postObj);
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>";

        $resultStr = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, $time, $msgType, $t);

        echo $resultStr;
    }
    public function retImg($url,$postObj){
        $imgtpl = "
                  <xml>
                  <ToUserName><![CDATA[%s]]></ToUserName>
                  <FromUserName><![CDATA[%s]]></FromUserName>
                  <CreateTime>%s</CreateTime>
                  <MsgType><![CDATA[%s]]></MsgType>
                  <Image>
                  <MediaId><![CDATA[%s]></MediaId>
                  </Image>
                  </xml>
                  ";
        $msgType = "image";
        $time = time($postObj);
        $resultStr = sprintf($imgtpl,$postObj->FromUserName, $postObj->ToUserName, $time, $msgType,$url);
        echo $resultStr;
    }

    public function retImgTex($Title, $ArticleCount, $Description, $PicUrl, $Url,$postObj){
        $imgtextTpl = "
                   <xml>
                   <ToUserName><![CDATA[%s]]></ToUserName>
                   <FromUserName><![CDATA[%s]]></FromUserName>
                   <CreateTime>%s</CreateTime>
                   <MsgType><![CDATA[%s]]></MsgType>
                   <ArticleCount>%s</ArticleCount>
                   <Articles>
                   <item>
                   <Title><![CDATA[%s]]></Title>
                   <Description><![CDATA[%s]]></Description>
                   <PicUrl><![CDATA[%s]]></PicUrl>
                   <Url><![CDATA[%s]]></Url>
                   </item>
                   </Articles>
                   </xml>
                   ";

        $msgType = "news";
        $time = time($postObj);
        $resultStr = sprintf($imgtextTpl, $postObj->FromUserName, $postObj->ToUserName, $time, $msgType, $ArticleCount,$Title,$Description,$PicUrl,$Url);

        echo $resultStr;
    }


      public function retMusic($Title, $Description, $musicUrl, $bettermusic, $postObj){
          $imgmusicTpl = "
                     <xml>
                                     <ToUserName><![CDATA[%s]]></ToUserName>
                                     <FromUserName><![CDATA[%s]]></FromUserName>
                                     <CreateTime>%s</CreateTime>
                                     <MsgType><![CDATA[%s]]></MsgType>
                                     <Music>
                                     <Title><![CDATA[%s]]></Title>
                                     <Description><![CDATA[%s]]></Description>
                                     <MusicUrl><![CDATA[%s]]></MusicUrl>
                                     <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
                                     </Music>
                                     </xml>
                     ";

          $msgType = "music";
          $time = time($postObj);
                  $resultStr = sprintf($imgmusicTpl, $postObj->FromUserName, $postObj->ToUserName, $time, $msgType, $Title, $Description, $musicUrl, $bettermusic);
          echo $resultStr;
      }


      public function retVoice($id, $postObj){
          $imgmusicTpl = "
                     <xml>
                                     <ToUserName><![CDATA[%s]]></ToUserName>
                                     <FromUserName><![CDATA[%s]]></FromUserName>
                                     <CreateTime>%s</CreateTime>
                                     <MsgType><![CDATA[%s]]></MsgType>
                                     <Voice>
                                     <MediaId><![CDATA[%s]]></MediaId>
                                     </Voice>
                     <FuncFlag>0</FuncFlag>
                                     </xml>
                     ";
      
          $msgType = "voice";
          $time = time($postObj);
          $s = $id;
                  $resultStr = sprintf($imgmusicTpl, $postObj->FromUserName, $postObj->ToUserName, $time, $msgType, $s );
          echo $resultStr;
      }

  };

  ?>
