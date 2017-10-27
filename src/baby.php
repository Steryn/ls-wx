<?php
// header('Access-Control-Allow-Origin:*');

$appid='wx5028eeb568c7544f';
$redirect_uri = urlencode('https://lab.secoinfo.net/discovery/dist/');
$url ="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
header("Location:".$url);
?>