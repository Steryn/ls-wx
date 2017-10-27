<?php
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
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
$outRefundNo = $_POST["out_refund_no"];
$refundId = $_POST["refund_id"];

if(isset($transactionId) && $transactionId != ""){
	$transaction_id = $_REQUEST["transaction_id"];
	$input = new WxPayRefundQuery();
	$input->SetTransaction_id($transaction_id);
	// printf_info(WxPayApi::refundQuery($input));
	print_r(json_encode(WxPayResults::Init(WxPayApi::refundQuery($input))));
	exit();
}

if(isset($outTradeNo) && $outTradeNo != ""){
	$out_trade_no = $_REQUEST["out_trade_no"];
	$input = new WxPayRefundQuery();
	$input->SetOut_trade_no($out_trade_no);
	// printf_info(WxPayApi::refundQuery($input));
	print_r(json_encode(WxPayResults::Init(WxPayApi::refundQuery($input))));
	exit();
}

if(isset($outRefundNo) && $outRefundNo != ""){
	$out_refund_no = $_REQUEST["out_refund_no"];
	$input = new WxPayRefundQuery();
	$input->SetOut_refund_no($out_refund_no);
	// printf_info(WxPayApi::refundQuery($input));
	print_r(json_encode(WxPayResults::Init(WxPayApi::refundQuery($input))));
	exit();
}

if(isset($refundId) && $refundId != ""){
	$refund_id = $_REQUEST["refund_id"];
	$input = new WxPayRefundQuery();
	$input->SetRefund_id($refund_id);
	// printf_info(WxPayApi::refundQuery($input));
	print_r(json_encode(WxPayResults::Init(WxPayApi::refundQuery($input))));	
	exit();
}
?>