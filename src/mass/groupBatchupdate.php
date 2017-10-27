<?php
    /****************************************************
    *  批量移动用户分组接口
    ****************************************************/
    require_once 'massApi.php';

    $result = json_encode($_POST['groupBatchupdate'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $mass->groupBatchupdate($result);
    echo json_encode($returnInfo);