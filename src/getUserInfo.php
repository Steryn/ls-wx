<?php
// header('Access-Control-Allow-Origin:*');
// $appid = "wx5028eeb568c7544f";
// $secret = "fb9f7edf8138dd07b54ae7e3b0a43599";
// $code = $_GET["code"];

$appid = $_POST['id'];
$secret = $_POST['secret'];
$code = $_POST['code'];

//第一步:取全局access_token
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
$token = getJson($url);

//第二步:取得openid并存储到coolie中
if(isset($_COOKIE['openid'])){
    $openid = $_COOKIE['openid'];
}else{
    $oauth2Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
    $oauth2 = getJson($oauth2Url);
    $openid = $oauth2['openid'];
    // $openid = "otA530uS8ohCScMts6ZSPUuPj-DE";
    setcookie('openid',$openid);
}
//第三步:根据全局access_token和openid查询用户信息
$access_token = $token["access_token"];  
$get_user_info_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
$userinfo = getJson($get_user_info_url);
 
//打印用户信息
$info = json_encode($userinfo);
echo $info;

function getJson($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return json_decode($output, true);
}
?>