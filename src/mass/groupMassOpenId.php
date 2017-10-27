<?php
    /****************************************************
    *  根据OpenID列表群发【订阅号不可用，服务号认证后可用】
    ****************************************************/
    require_once 'massApi.php';

    $result = json_encode($_POST['massOpenId'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $mass->groupMassOpenId($result);
    echo json_encode($returnInfo);