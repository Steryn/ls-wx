<?php
    /****************************************************
    *  查询群发消息发送状态【订阅号与服务号认证后均可用】
    ****************************************************/
    require_once 'massApi.php';
    
    $result = json_encode($_POST['massGet'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $mass->massGet($result);
    echo $returnInfo;