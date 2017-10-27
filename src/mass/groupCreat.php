<?php
    /****************************************************
    *  创建分组【订阅号与服务号认证后均可用】
    ****************************************************/
    require_once 'massApi.php';

    $result = json_encode($_POST['groupCreat'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $mass->groupCreat($result);
    echo json_encode($returnInfo);