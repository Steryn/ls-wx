<?php

header('Content-Type: text/html; charset=UTF-8');

//_reply_customer("o2nQet9fLRkd9Wyu-40jaAiZco7g", "Hello");

function _reply_customer($touser,$content){
	
	//更换成自己的APPID和APPSECRET
	$APPID="wxef78f26f877xx5c2";
	$APPSECRET="3f39a6eaxxxx7284057b8170d50e21a2";
	
	$TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APPID."&secret=".$APPSECRET;
	
	$json=file_get_contents($TOKEN_URL);
	$result=json_decode($json);
	
	$ACC_TOKEN=$result->access_token;
	
	$data = '{
	    "touser":"'.$touser.'",
	    "msgtype":"text",
	    "text":
	    {
	         "content":"'.$content.'"
	    }
	}';
	
	$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$ACC_TOKEN;
	
	$result = https_post($url,$data);
	$final = json_decode($result);
	return $final;
}

function https_post($url,$data)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    if (curl_errno($curl)) {
       return 'Errno'.curl_error($curl);
    }
    curl_close($curl);
    return $result;
}

?>