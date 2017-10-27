<?php
    require_once "../lib/WxPay.Config.php";
    require_once "../lib/WxPay.Data.php";
    require_once "../lib/WxPay.Api.php";
    require_once "WxPay.NativePay.php";

    $x = "<xml><appid>wxbbd0d3f092cc62cb</appid><mch_id>1315685301</mch_id><nonce_str>t0pmxog4xvkuefxqotiwpjdaa26nexsg</nonce_str><op_user_id>1315685301</op_user_id><out_refund_no>131568530120170322182559</out_refund_no><refund_fee>1</refund_fee><total_fee>1</total_fee><transaction_id>4007732001201703224246799208</transaction_id></xml>";
    // echo $x;
    $zi = xmlToArray($x);
    print_r($zi);
    function xmlToArray($xml){
        //禁止引用外部xml实体 
        libxml_disable_entity_loader(true); 
        $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA); 
        $val = json_decode(json_encode($xmlstring),true); 
        return $val; 
    } 
