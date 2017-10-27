<?php
    /****************************************************
    *  客服接口-发消息
    ****************************************************/
    require_once 'customServiceApi.php';

    $result = json_encode($_POST['customSend'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $custom->customSend($result);
    echo json_encode($returnInfo);