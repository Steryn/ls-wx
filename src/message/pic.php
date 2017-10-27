<?php
/*
    sexoffice
    CopyRight 2013  baronyang
*/

define("TOKEN", "discovery");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->responseMsg();

class wechatCallbackapiTest
{
  private $fromUsername;
  private $toUsername;
  private $keywordl;
  private $time;
  private $MsgType;
  private $EventType;
  //回复文本信息 XML是回复的格式
  private function  ReplyTextMsg($sendmsg){  
          	$textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
         $resultStr = sprintf($textTpl, $this->fromUsername, $this->toUsername, $this->time, 'text', $sendmsg);
         echo $resultStr;
  }
   //关注后回复图文信息
  private function AttentionReply1(){
     $textTpl="	<xml>
 					<ToUserName><![CDATA[%s]]></ToUserName>
 					<FromUserName><![CDATA[%s]]></FromUserName>
 					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
 					<ArticleCount>1</ArticleCount>
 					<Articles>
 						<item>
 							<Title><![CDATA[%s]]></Title> 
 							<Description><![CDATA[%s]]></Description>
 							<PicUrl><![CDATA[%s]]></PicUrl>
 							<Url><![CDATA[%s]]></Url>
 						</item> 						
 					</Articles>
 					<FuncFlag>1</FuncFlag>
 				</xml>";
        $title1="道具研究所欢迎您";
    	$Description1="亲，欢迎您关注道具研究所，";
        $Description1.="大部份内容";
    	$PicUrl1="";
    	$Url1="http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5OTkxNjIwMw==&appmsgid=10000050&itemidx=1&sign=cf074e4612e18689a0c79d8f5555f791#wechat_redirect";       

    	$resultStr = sprintf($textTpl, $this->fromUsername, $this->toUsername, $this->time,$title1,$Description1,$PicUrl1,$Url1);
        echo $resultStr;    
  }
  
  //关注后回复图文信息
  private function AttentionReply2(){
     $textTpl="	<xml>
 					<ToUserName><![CDATA[%s]]></ToUserName>
 					<FromUserName><![CDATA[%s]]></FromUserName>
 					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
 					<ArticleCount>3</ArticleCount>
 					<Articles>
 						<item>
 							<Title><![CDATA[%s]]></Title> 
 							<Description><![CDATA[%s]]></Description>
 							<PicUrl><![CDATA[%s]]></PicUrl>
 							<Url><![CDATA[%s]]></Url>
 						</item>
 						<item>
 							<Title><![CDATA[%s]]></Title>
 							<Description><![CDATA[%s]]></Description>
 							<PicUrl><![CDATA[%s]]></PicUrl>
 							<Url><![CDATA[%s]]></Url>
 						</item>
						<item>
 							<Title><![CDATA[%s]]></Title>
 							<Description><![CDATA[%s]]></Description>
 							<PicUrl><![CDATA[%s]]></PicUrl>
 							<Url><![CDATA[%s]]></Url>
 						</item>
 					</Articles>
 					<FuncFlag>1</FuncFlag>
 				</xml>";
        $title1="起来";
    	$Description1="1";
    	$PicUrl1="";
    	$Url1="http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5OTkxNjIwMw==&appmsgid=10000044&itemidx=1&sign=e888bafa310611f0d8ad9c5f979316f0#wechat_redirect";
        
    	$title2="让";
    	$Description2="2";
    	$PicUrl2="";
    	$Url2="http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5OTkxNjIwMw==&appmsgid=10000044&itemidx=2&sign=85285c0119705e81b75055315953563f#wechat_redirect";

		$title3="记忆";
    	$Description3="3";
    	$PicUrl3="";
    	$Url3="http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5OTkxNjIwMw==&appmsgid=10000044&itemidx=3&sign=e615e719436cb3efc6d61d2dcb938dd5#wechat_redirect";
	
    	$resultStr = sprintf($textTpl, $this->fromUsername, $this->toUsername, $this->time,$title1,$Description1,$PicUrl1,$Url1,
                             $title2,$Description2,$PicUrl2,$Url2,$title3,$Description3,$PicUrl3,$Url3);
        echo $resultStr;    
  }
  //定制回复信息
  public function responseMsg()  {	//取用户数据
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];    

        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $this->fromUsername = $postObj->FromUserName;//用户的微信号加密ID
            $this->toUsername = $postObj->ToUserName;    //开发者ID
            $this->keyword = trim($postObj->Content);
            $this->MsgType=utf8_decode($postObj->MsgType);			//消息类型
            if (property_exists($postObj,"Event")==true) {
            	$this->EventType=utf8_decode($postObj->Event);
          	}
            $this->time = time();

            if($this->MsgType == "text"){
              if (utf8_decode(trim($this->keyword))=="?"){                
                  $contentStr=" 亲!您想了解哪个哪类型的?";
                  $this->ReplyTextMsg($contentStr);
                  exit;
              } 
              if (utf8_decode(trim($this->keyword))=="A"){
                  $contentStr =$this->fromUsername." 请了解";
                  $this->ReplyTextMsg($contentStr);
                  $this->ReplyTextMsg("test");
                  exit;                
              }             
            }
          if ($this->MsgType=='event'){
            //当公众账号被关注后，自动回复图文信息
            if ($this->EventType=='subscribe'){ 
               
              //$this->AttentionReply2(); 本来想回复两条的，结果微信只能回复一条，屏蔽了这一条
               $this->AttentionReply1();
               exit;
            }            
          }
		}
	}
 }
?>