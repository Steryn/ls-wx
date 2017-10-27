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
$totalFee = $_POST["total_fee"];
$refundFee = $_POST["refund_fee"];
if(isset($transactionId) && $transactionId != ""){
	$transaction_id = $_REQUEST["transaction_id"];
	$total_fee = $_REQUEST["total_fee"];
	$refund_fee = $_REQUEST["refund_fee"];
	$input = new WxPayRefund();
	$input->SetTransaction_id($transaction_id);
	$input->SetTotal_fee($total_fee);
	$input->SetRefund_fee($refund_fee);
    $input->SetOut_refund_no(WxPayConfig::MCHID.date("YmdHis"));
    $input->SetOp_user_id(WxPayConfig::MCHID);
	// printf_info(WxPayApi::refund($input));
	print_r(json_encode(WxPayResults::Init(WxPayApi::refund($input))));
	exit();
}

if(isset($outTradeNo) && $outTradeNo != ""){
	$out_trade_no = $_REQUEST["out_trade_no"];
	$total_fee = $_REQUEST["total_fee"];
	$refund_fee = $_REQUEST["refund_fee"];
	$input = new WxPayRefund();
	$input->SetOut_trade_no($out_trade_no);
	$input->SetTotal_fee($total_fee);
	$input->SetRefund_fee($refund_fee);
    $input->SetOut_refund_no(WxPayConfig::MCHID.date("YmdHis"));
    $input->SetOp_user_id(WxPayConfig::MCHID);
	// printf_info(WxPayApi::refund($input));
	print_r(json_encode(WxPayResults::Init(WxPayApi::refund($input))));
	exit();
}
?>