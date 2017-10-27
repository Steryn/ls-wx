<?php
/**
 * 微信公众平台-多图文回复功能源代码
 * ================================
 * Copyright 2013-2014 David Tang
 * http://www.cnblogs.com/mchina/
 * http://www.joythink.net/
 * ================================
 * Author:David
 * 个人微信：mchina_tang
 * 公众微信：zhuojinsz
 * Date:2013-10-09
 */

//引入回复多图文的函数文件
require_once 'responseMultiNews.func.inc.php';

//define your token
define("TOKEN", "discovery");
$wechatObj = new wechatCallbackapi();
$wechatObj->responseMsg();
//$wechatObj->valid();

class wechatCallbackapi
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
				$RX_TYPE = trim($postObj->MsgType);

				switch($RX_TYPE)
				{
					case "text":
						$resultStr = $this->handleText($postObj);
						break;
					case "event":
						$resultStr = $this->handleEvent($postObj);
						break;
					default:
						$resultStr = "Unknow msg type: ".$RX_TYPE;
						break;
				}
				echo $resultStr;
		}else{
			echo "";
			exit;
		}
	}

	public function handleText($postObj)
    {
        $keyword = trim($postObj->Content);

        if(!empty( $keyword ))
        {
			$record[0]=array(
				'title' =>'观前街',
				'description' =>'观前街位于江苏苏州市区，是成街于清朝时期的百年商业老街，街上老店名店云集，名声远播海内外...',
				'picUrl' => 'http://joythink.duapp.com/images/suzhou.jpg',
				'url' =>'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NDM0NTEyMg==&appmsgid=10000052&itemidx=1&sign=90518631fd3e85dd1fde7f77c04e44d5#wechat_redirect'
			);
			$record[1]=array(
				'title' =>'拙政园',
				'description' =>'拙政园位于江苏省苏州市平江区，是苏州四大古名园之一，也是苏州园林中最大、最著名的一座，被列入《世界文化遗产名录》，堪称中国私家园林经典...',
				'picUrl' => 'http://joythink.duapp.com/images/suzhouScenic/zhuozhengyuan.jpg',
				'url' =>'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NDM0NTEyMg==&appmsgid=10000040&itemidx=1&sign=a6d4921f2d17ba2ea3ef577608db887b#wechat_redirect'
			);
			$record[2]=array(
				'title' =>'周庄',
				'description' =>'周庄历经900多年沧桑，仍完整地保存着原来的水乡集镇的建筑风貌，全镇百分之六十以上的民居仍为明清建筑，有近百座古典宅院和60多个砖雕门楼，最有代表性的当数沈厅、张厅...',
				'picUrl' => 'http://joythink.duapp.com/images/suzhouScenic/zhouzhuang.jpg',
				'url' =>'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NDM0NTEyMg==&appmsgid=10000042&itemidx=1&sign=f3781d7c1f83b5a440c7339d0b17586c#wechat_redirect'
			);

			$record[3]=array(
				'title' =>'虎丘',
				'description' =>'虎丘，位于苏州城西北郊，距城区中心五公里。享有“吴中第一名胜”的美誉...',
				'picUrl' => 'http://joythink.duapp.com/images/suzhouScenic/huqiu.jpg',
				'url' =>'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NDM0NTEyMg==&appmsgid=10000044&itemidx=1&sign=d33bd2c6b1cdbfd9787bea50d1a84b9f#wechat_redirect'
			);
			$record[4]=array(
				'title' =>'狮子林',
				'description' =>'狮子林位于江苏苏州市市城东北园林路，为苏州四大名园之一，至今已有650多年的历史...',
				'picUrl' => 'http://joythink.duapp.com/images/suzhouScenic/shizilin.jpg',
				'url' =>'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NDM0NTEyMg==&appmsgid=10000054&itemidx=1&sign=9670461543b5bf5c0e6650c41534f973#wechat_redirect'
			);
			$record[5]=array(
				'title' =>'山塘街',
				'description' =>'山塘街东起阊门渡僧桥，西至苏州名胜虎丘山的望山桥，长约七里，所以苏州俗语说“七里山塘到虎丘”...',
				'picUrl' => 'http://joythink.duapp.com/images/suzhouScenic/shantangjie.jpg',
				'url' =>'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NDM0NTEyMg==&appmsgid=10000046&itemidx=1&sign=9e7707d5615907d483df33ee449b378d#wechat_redirect'
			);
			$record[6]=array(
				'title' =>'留园',
				'description' =>'留园位于江苏苏州，是中国著名古典园林，以园内建筑布置精巧、奇石众多而知名。与苏州拙政园、北京颐和园、承德避暑山庄并称中国四大名园...',
				'picUrl' => 'http://joythink.duapp.com/images/suzhouScenic/liuyuan.jpg',
				'url' =>'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NDM0NTEyMg==&appmsgid=10000048&itemidx=1&sign=9bf0674dbb6cf4cdb7b647c7a83b1181#wechat_redirect'
			);
			$record[7]=array(
				'title' =>'平江路',
				'description' =>'平江路位于苏州古城东北，是一条傍河的小路，北接拙政园，南眺双塔，全长1606米，是苏州一条历史攸久的经典水巷。宋元时候苏州又名平江，以此名路...',
				'picUrl' => 'http://joythink.duapp.com/images/suzhouScenic/pingjianglu.jpg',
				'url' =>'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NDM0NTEyMg==&appmsgid=10000056&itemidx=1&sign=ef18a26ce78c247f3071fb553484d97a#wechat_redirect'
			);
			$record[8]=array(
				'title' =>'留园',
				'description' =>'留园位于江苏苏州，是中国著名古典园林，以园内建筑布置精巧、奇石众多而知名。与苏州拙政园、北京颐和园、承德避暑山庄并称中国四大名园...',
				'picUrl' => 'http://joythink.duapp.com/images/suzhouScenic/liuyuan.jpg',
				'url' =>'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NDM0NTEyMg==&appmsgid=10000048&itemidx=1&sign=9bf0674dbb6cf4cdb7b647c7a83b1181#wechat_redirect'
			);
			$record[9]=array(
				'title' =>'平江路',
				'description' =>'平江路位于苏州古城东北，是一条傍河的小路，北接拙政园，南眺双塔，全长1606米，是苏州一条历史攸久的经典水巷。宋元时候苏州又名平江，以此名路...',
				'picUrl' => 'http://joythink.duapp.com/images/suzhouScenic/pingjianglu.jpg',
				'url' =>'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NDM0NTEyMg==&appmsgid=10000056&itemidx=1&sign=ef18a26ce78c247f3071fb553484d97a#wechat_redirect'
			);
			$record[10]=array(
				'title' =>'留园',
				'description' =>'留园位于江苏苏州，是中国著名古典园林，以园内建筑布置精巧、奇石众多而知名。与苏州拙政园、北京颐和园、承德避暑山庄并称中国四大名园...',
				'picUrl' => 'http://joythink.duapp.com/images/suzhouScenic/liuyuan.jpg',
				'url' =>'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NDM0NTEyMg==&appmsgid=10000048&itemidx=1&sign=9bf0674dbb6cf4cdb7b647c7a83b1181#wechat_redirect'
			);
			$record[11]=array(
				'title' =>'平江路',
				'description' =>'平江路位于苏州古城东北，是一条傍河的小路，北接拙政园，南眺双塔，全长1606米，是苏州一条历史攸久的经典水巷。宋元时候苏州又名平江，以此名路...',
				'picUrl' => 'http://joythink.duapp.com/images/suzhouScenic/pingjianglu.jpg',
				'url' =>'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NDM0NTEyMg==&appmsgid=10000056&itemidx=1&sign=ef18a26ce78c247f3071fb553484d97a#wechat_redirect'
			);

			$resultStr = _response_multiNews($postObj,$record);
			echo $resultStr;
        }else{
            echo "Input something...";
        }
    }

    public function handleEvent($object)
    {
        $contentStr = "";
        switch ($object->Event)
        {
            case "subscribe":
				$record=array(
					'title' =>'观前街',
					'description' =>'观前街位于江苏苏州市区，是成街于清朝时期的百年商业老街，街上老店名店云集，名声远播海内外...',
					'picUrl' => 'http://joythink.duapp.com/images/suzhou.jpg',
					'url' =>'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NDM0NTEyMg==&appmsgid=10000052&itemidx=1&sign=90518631fd3e85dd1fde7f77c04e44d5#wechat_redirect'
				);

				$resultStr = _response_multiNews($object,$record);
                break;
            default :
                $resultStr = "Unknow Event: ".$object->Event;
                break;
        }
        return $resultStr;
    }
		
	private function checkSignature()
	{
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
}

?>