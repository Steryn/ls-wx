<?php
    require_once "../lib/WxPay.Config.php";
    require_once "../lib/WxPay.Data.php";
    require_once "../lib/WxPay.Api.php";

	$call = new WxPayApi();
	$bcak = function(){
		alert('successs');
	};
	$xml = $call->notify($back,"err");
	echo $xml;
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>微信支付样例-退款</title>
</head>
<body>
	<div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">扫描支付模式一</div><br/>
	<img alt="模式一扫码支付" src="https://lab.secoinfo.net/discovery/dist/example/qrcode.php?data=<?php echo urlencode($url1);?>" style="width:150px;height:150px;"/>
	<br/><br/><br/>
	<div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">扫描支付模式二</div><br/>
	<img alt="模式二扫码支付" src="https://lab.secoinfo.net/discovery/dist/example/qrcode.php?data=<?php echo urlencode($url2);?>" style="width:150px;height:150px;"/>
</body>
</html>