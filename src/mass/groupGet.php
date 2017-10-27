<?php
    /****************************************************
    *  查询所有分组
    ****************************************************/
    require_once 'massApi.php';

    $result = json_encode($_POST['groupGet'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $mass->groupGet($result);
    echo json_encode($returnInfo);