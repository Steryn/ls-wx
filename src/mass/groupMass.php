<?php
    /****************************************************
    *  根据分组进行群发【订阅号与服务号认证后均可用】
    ****************************************************/
    require_once 'massApi.php';

    $result = json_encode($_POST['groupMass'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $mass->groupMass($result);
    echo json_encode($returnInfo);