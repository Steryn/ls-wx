<?php
    /****************************************************
    *  删除分组接口
    ****************************************************/
    require_once 'massApi.php';

    $result = json_encode($_POST['groupDelete'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $mass->groupDelete($result);
    echo json_encode($returnInfo);