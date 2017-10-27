<?php
    /****************************************************
    *  查询用户所在分组
    ****************************************************/
    require_once 'massApi.php';

    $result = json_encode($_POST['groupGetId'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $mass->groupGetId($result);
    echo json_encode($returnInfo);