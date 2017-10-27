<?php
    /****************************************************
    *  上传图文消息素材【订阅号与服务号认证后均可用】
    ****************************************************/
    require_once 'massApi.php';
    
    $result = json_encode($_POST['uploadnews'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $mass->uploadnews($result);
    echo $returnInfo;