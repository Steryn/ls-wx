<?php
require_once "../lib/WxPay.Api.php";
//require_once "../lib/WxPay.MicroPay.php";

//获取参数
$billDate = $_POST["bill_date"];
$billType = $_POST["bill_type"];

if(isset($billDate) && $billType != ""){
	// $bill_date = $_REQUEST["bill_date"];
    // $bill_type = $_REQUEST["bill_type"];
	$input = new WxPayDownloadBill();
	$input->SetBill_date($billDate);
	$input->SetBill_type($billType);
	$file = WxPayApi::downloadBill($input);
	echo $file;
	//TODO 对账单文件处理
    exit(0);
}
?>