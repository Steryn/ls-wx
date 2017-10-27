<?php
/**
  * 作者：seven
  * 网址：
  * 微信订阅号：siyuliu
  */

define("TOKEN", "discovery");
$wechatObj = new wechatCallbackapi();
if (isset($_GET['echostr'])) {     //验证微信
    $wechatObj->valid();
}else{                     //回复消息
    $wechatObj->responseMsg();
}

class wechatCallbackapi
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
		if (!defined("TOKEN")) {
			throw new Exception('TOKEN is not defined!');
		}
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    //回复消息
    public function responseMsg()
	{
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
    if (!empty($postStr)){
		libxml_disable_entity_loader(true);//防止文件泄漏
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $RX_TYPE = trim($postObj->MsgType);

        switch ($RX_TYPE)
        {
            case "text":
                $resultStr = $this->receiveText($postObj);
                break;
            case "image":
                $resultStr = $this->receiveImage($postObj);
                break;
            case "location":
                $resultStr = $this->receiveLocation($postObj);
                break;
            case "voice":
                $resultStr = $this->receiveVoice($postObj);
                break;
            case "video":
                $resultStr = $this->receiveVideo($postObj);
                break;
            case "link":
                $resultStr = $this->receiveLink($postObj);
                break;
            case "event":
                $resultStr = $this->receiveEvent($postObj);
                break;
            default:
                $resultStr = "unknow msg type: ".$RX_TYPE;
                break;
        }
        echo $resultStr;
    }else {
        echo "";
        exit;
    	}
	}
    
    //接收文本消息
    private function receiveText($object)
    {
		// $fromUsername = $object->FromUserName;
		// $toUsername = $object->ToUserName;
		$keyword = trim($object->Content);
		$time = time();

		if($keyword == '文本'){
			$itemTpl="<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[text]]></MsgType>
			<Content><![CDATA[fromusername:%s]]></Content>
			</xml>";
			$result = sprintf($itemTpl, $object->FromUserName, $object->ToUserName, time(), $object->FromUserName);
			// echo $result;
		}
		return $result;
    }

    //接收事件，关注等
    private function receiveEvent($object)
    {
        // $contentStr = "";
        switch ($object->Event)
        {
            case "subscribe":
                // $contentStr = "你关注了我";    //关注后回复内容
				// ---------------------------------------
				$textTpl="<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[text]]></MsgType>
						<Content><![CDATA[你关注了我]]></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";
				$contentStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
				// ---------------------------------------
                break;
            case "unsubscribe":
                $contentStr = "";
                break;
            case "CLICK":
                $contentStr =  $this->receiveClick($object);    //点击事件
                break;
            default:
                $contentStr = "receive a new event: ".$object->Event;
                break;
        }
        return $contentStr;
    }
    
    //接收图片
    private function receiveImage($object)
    {
        $contentStr = "你发送的是图片，地址为：".$object->PicUrl;
        $resultStr = $this->transmitText($object, $contentStr);
        return $resultStr;
    }

    //接收语音
    private function receiveVoice($object)
    {
        $contentStr = "你发送的是语音，媒体ID为：".$object->MediaId;
        $resultStr = $this->transmitText($object, $contentStr);
        return $resultStr;
    }
    
    //接收视频
    private function receiveVideo($object)
    {
        $contentStr = "你发送的是视频，媒体ID为：".$object->MediaId;
        $resultStr = $this->transmitText($object, $contentStr);
        return $resultStr;
    }
    
    //位置消息
    private function receiveLocation($object)
    {
        $contentStr = "你发送的是位置，纬度为：".$object->Location_X."；经度为：".$object->Location_Y."；缩放级别为：".$object->Scale."；位置为：".$object->Label;
        $resultStr = $this->transmitText($object, $contentStr);
        return $resultStr;
    }
    
    //链接消息
    private function receiveLink($object)
    {
        $contentStr = "你发送的是链接，标题为：".$object->Title."；内容为：".$object->Description."；链接地址为：".$object->Url;
        $resultStr = $this->transmitText($object, $contentStr);
        return $resultStr;
    }

   //点击菜单消息
    private function receiveClick($object)
    {
         switch ($object->EventKey)
         {
             case "1":
             $contentStr = "【班服，情侣装，亲子装等，有长短T恤，卫衣，长短裤】";
             break;
             
             case "2":
             $contentStr = "你点击了菜单: ".$object->EventKey;
             break;
             
             case "3":
             $contentStr = "是傻逼";
             break;
             
             default:
             $contentStr = "你点击了菜单: ".$object->EventKey;
             break;
         }
        
        
        //两种回复
        if (is_array($contentStr)){
            $resultStr = $this->transmitNews($object, $contentStr);
        }else{
            $resultStr = $this->transmitText($object, $contentStr);
        }
        return  $resultStr;
    }
    
    //回复文本消息
    private function transmitText($object, $content)
    {
        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[text]]></MsgType>
        <Content><![CDATA[%s]]></Content>
        </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $resultStr;
    }
    
    //回复图文
    private function transmitNews($object, $arr_item)
    {
        if(!is_array($arr_item))
            return;
        $itemTpl = "<item>
				<Title><![CDATA[%s]]></Title>
				<Description><![CDATA[%s]]></Description>
				<PicUrl><![CDATA[%s]]></PicUrl>
				<Url><![CDATA[%s]]></Url>
			</item>";
        $item_str = "";
        foreach ($arr_item as $item)
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
       	$newsTpl = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[news]]></MsgType>
			<Content><![CDATA[]]></Content>
			<ArticleCount>%s</ArticleCount>
			<Articles>
			$item_str</Articles>
			</xml>";
        $resultStr = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item));
        return $resultStr;
    }
    
    //音乐消息
    private function transmitMusic($object, $musicArray, $flag = 0)
    {
        $itemTpl = "<Music>
			<Title><![CDATA[%s]]></Title>
			<Description><![CDATA[%s]]></Description>
			<MusicUrl><![CDATA[%s]]></MusicUrl>
			<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
			</Music>";
        $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);
        $textTpl = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[music]]></MsgType>
			$item_str
			<FuncFlag>%d</FuncFlag>
			</xml>"; 
       $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $flag);
        return $resultStr;
    }
}

?>