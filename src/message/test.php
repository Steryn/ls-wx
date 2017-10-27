<?php
/**
 * 微信公共平台消息回复类
 *
 *
 */
$response = new BBCweixin();
class BBCweixin{
 
 private $APPID="wx5028eeb568c7544f";
 private $APPSECRET="fb9f7edf8138dd07b54ae7e3b0a43599";
 /*
  *文本消息回复
  *@param array object
  *@param string content
  *@return string
  */
 public function resText($object,$flag=0){
    $xmlText="<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[text]]></MsgType>
    <Content><![CDATA[%s]]></Content>
    <FuncFlag>%d</FuncFlag>
    </xml>";
    $resultStr=sprintf($xmlText,$object->FromUserName,"otA530uS8ohCScMts6ZSPUuPj-DE",time(),$object->content,$flag);
    echo $resultStr;exit();
 }
 /*
  *图片消息回复
  *@param array object
  *@param string url
  *@return string
  */
 public function resImage($object,$media_id){
    $xmlImage="<xml>";
    $xmlImage.="<ToUserName><![CDATA[%s]]></ToUserName>";
    $xmlImage.="<FromUserName><![CDATA[%s]]></FromUserName>";
    $xmlImage.="<CreateTime>%s</CreateTime>";
    $xmlImage.="<MsgType><![CDATA[image]]></MsgType>";
    $xmlImage.="<Image><MediaId><![CDATA[%s]]></MediaId></Image>";
    $xmlImage.="</xml>";
    $resultStr=sprintf($xmlImage,$object->FromUserName,$object->ToUserName,time(),$media_id);
    echo $resultStr;exit();
 }
 /*
  *图文消息回复
  *@param array object
  *@param array newsData 二维数组 必须包含[Title][Description][PicUrl][Url]字段
  *@return string
  */
 public function resNews($object,$newsData=array()){
     $CreateTime=time();
     $FuncFlag=0;
     $newTplHeader="<xml>
        <ToUserName><![CDATA[{$object->FromUserName}]]></ToUserName>
        <FromUserName><![CDATA[{$object->ToUserName}]]></FromUserName>
        <CreateTime>{$CreateTime}</CreateTime>
        <MsgType><![CDATA[news]]></MsgType>
        <Content><![CDATA[%s]]></Content>
        <ArticleCount>%s</ArticleCount><Articles>";
     $newTplItem="<item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
        </item>";
     $newTplFoot="</Articles>
        <FuncFlag>%s</FuncFlag>
        </xml>";
     $Content='';
     $itemsCount=count($newsData);
     $itemsCount=$itemsCount<10?$itemsCount:10;//微信公众平台图文回复的消息一次最多10条
     if($itemsCount){
      foreach($newsData as $key=>$item){
       if($key<=9){
        $Content.=sprintf($newTplItem,$item['Title'],$item['Description'],$item['PicUrl'],$item['Url']);
        }
      }
  }
     $header=sprintf($newTplHeader,0,$itemsCount);
     $footer=sprintf($newTplFoot,$FuncFlag);
     echo $header.$Content.$footer;exit();
 }
 
 /*
  *音乐消息回复
  *@param array object
  *@param array musicContent 二维数组 包含[Title][Description][MusicUrl][HQMusicUrl]字段
  *@return string
  */
 public function resMusic($object,$musicContent=array()){
   $xmlMusic="<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[music]]></MsgType>
            <Music>
            <Title><![CDATA[%s]]></Title>
            <Description><![CDATA[%s]]></Description>
            <MusicUrl><![CDATA[%s]]></MusicUrl>
            <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
            </Music>
            </xml>";
  if(empty($musicContent[0]['HQMusicUrl'])){
    $musicContent[0]['HQMusicUrl']=$musicContent[0]['MusicUrl'];
    }
    $resultStr=sprintf($xmlMusic,$object->FromUserName,$object->ToUserName,time(),$musicContent[0]['Title'],$musicContent[0]['Description'],$musicContent[0]['MusicUrl'],$musicContent[0]['HQMusicUrl']);
    echo $resultStr;exit();
 }
 /*
  *上传多媒体文件接口
  *@param 
  *@param array mediaArr filename、filelength、content-type
  *@return object
  */
 public function uploadMedia($accessToken,$type='image',$mediaArr){
    $url="http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=".$accessToken."&type=".$type;
    $doPost=self::curlPost($mediaArr,$url);
    return $doPost;
 }
 /*
  *GPS,谷歌坐标转换成百度坐标
  *@param lnt
  *@param lat
  *@return array
  */
 public function mapApi($lng,$lat,$type){
  $map=array();
  if($type=='gps'){
   $url="http://map.yanue.net/gpsApi.php?lat=".$lat."&lng=".$lng;
   $res=json_decode(file_get_contents($url));
   $map['lng']=$res->baidu->lng;
   $map['lat']=$res->baidu->lat;
  }
  if($type=='google'){
   $url="http://api.map.baidu.com/ag/coord/convert?from=2&to=4&mode=1&x=".$lng."&y=".$lat;
   $res=json_decode(file_get_contents($url));
   $map['lng']=base64_decode($res[0]->x);
   $map['lat']=base64_decode($res[0]->y);
  }
  return $map;
 }
 
 /**************************************************************
  *
  *  使用特定function对数组中所有元素做处理
  *  @param  string  &$array     要处理的字符串
  *  @param  string  $function   要执行的函数
  *  @return boolean $apply_to_keys_also     是否也应用到key上
  *  @access public
  *
  *************************************************************/
 public function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
 {
  static $recursive_counter = 0;
  if (++$recursive_counter > 1000) {
   die('possible deep recursion attack');
  }
  foreach ($array as $key => $value) {
   if (is_array($value)) {
    self::arrayRecursive($array[$key], $function, $apply_to_keys_also);
   } else {
    $array[$key] = $function($value);
   }
 
   if ($apply_to_keys_also && is_string($key)) {
    $new_key = $function($key);
    if ($new_key != $key) {
     $array[$new_key] = $array[$key];
     unset($array[$key]);
    }
   }
  }
  $recursive_counter--;
 }
 
 /**************************************************************
  *
  *  将数组转换为JSON字符串（兼容中文）
  *  @param  array   $array      要转换的数组
  *  @return string      转换得到的json字符串
  *  @access public
  *
  *************************************************************/
 public function JSON($array) {
  self::arrayRecursive($array, 'urlencode', true);
  $json = json_encode($array);
  return urldecode($json);
 }
 /*
  *创建菜单
  *
  */
 public function creatMenu($shop_id,$data){
  $jsonArray=self::JSON($data);
  $AccessToken=self::accessToken($weiXin[0]['key'],$weiXin[0]['secret']);
  $MENU_URL="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$AccessToken;
  return self::curlPost($jsonArray,$MENU_URL);
 }
 /*
  *客服消息回复
  *@param array jsonArray Array {"touser":"OPENID","msgtype":"text","text":{"content":"Hello World"}}
  *@return string
  */
 
  public function customService($jsonArray,$hash){
  if(empty($jsonArray)){
   return false; 
  }
  $db=M();
  $sql="select * from bbc_wechats where hash='".$hash."'";
  $weChast=$db->query($sql);
  $AccessToken=self::accessToken($weChast[0]['key'],$weChast[0]['secret']);
  $TokenUrl="https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$AccessToken;
     $CustomRes=self::curlPost($jsonArray,$TokenUrl);
  return $CustomRes;
  }
  /*
 
   *获取access_token
   *@return objectStr
   */
  public function accessToken($appid,$secret){ 
   $access_token=BBCcache::getCache('accesstoken'.$appid);
   if($access_token){
    $AccessTokenRet=$access_token;
   }else{
    $TookenUrl="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
    $AccessTokenRes=@file_get_contents($TookenUrl);
    $AccessToken=json_decode($AccessTokenRes);
    $AccessTokenRet=$AccessToken->access_token;
    BBCcache::setCache('accesstoken'.$appid,$AccessToken->access_token,3600);
   }
   return $AccessTokenRet;
  }
  /*
   *向远程接口POST数据
   *@data Array {"touser":"OPENID","msgtype":"text","text":{"content":"Hello World"}}
   *@return objectArray
   */
  public function curlPost($data,$url){
    $ch = curl_init();
 
   curl_setopt($ch, CURLOPT_URL, $url); 
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
 
   $info = curl_exec($ch);
 
   if (curl_errno($ch)) {
    echo 'Errno'.curl_error($ch);
   }
 
   curl_close($ch);
   return json_decode($info);
  }
 //根据经纬度计算距离和方向
 function getRadian($d){
  return $d * M_PI / 180;
 }
 
 function getDistance ($lat1, $lng1, $lat2, $lng2){
  $EARTH_RADIUS=6378.137;//地球半径
  $lat1 =getRadian($lat1);
  $lat2 = getRadian($lat2);
 
  $a = $lat1 - $lat2;
  $b = getRadian($lng1) - getRadian($lng2);
 
  $v = 2 * asin(sqrt(pow(sin($a/2),2) + cos($lat1) * cos($lat2) * pow(sin($b/2),2)));
 
  $v = round($EARTH_RADIUS * $v * 10000) / 10000;
 
  return $v;
 }
}
?>