<?php
    /****************************************************
    *  修改分组名
    ****************************************************/
    require_once 'massApi.php';

    $result = json_encode($_POST['groupUpdata'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $mass->groupUpdata($result);
    echo json_encode($returnInfo);