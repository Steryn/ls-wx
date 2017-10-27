<?php
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("./logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

function printf_info($data)
{
    foreach($data as $key=>$value){
        echo "<font color='#f00;'>$key</font> : $value <br/>";
    }
}
//获取参数
$transactionId = $_POST["transaction_id"];
$outTradeNo = $_POST["out_trade_no"];
if(isset($transactionId) && $transactionId != ""){
	$transaction_id = $_REQUEST["transaction_id"];
	$input = new WxPayOrderQuery();
	$input->SetTransaction_id($transaction_id);
	// printf_info(WxPayApi::orderQuery($input));
	print_r(json_encode(WxPayResults::Init(WxPayApi::orderQuery($input))));
	exit();
}

if(isset($outTradeNo) && $outTradeNo != ""){
	$out_trade_no = $_REQUEST["out_trade_no"];
	$input = new WxPayOrderQuery();
	$input->SetOut_trade_no($out_trade_no);
	// printf_info(WxPayApi::orderQuery($input));
	print_r(json_encode(WxPayResults::Init(WxPayApi::orderQuery($input))));
	exit();
}
?>