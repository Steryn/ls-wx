<?php
    /****************************************************
    *  移动用户分组
    ****************************************************/
    require_once 'massApi.php';

    $result = json_encode($_POST['groupMember'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $mass->groupMember($result);
    echo json_encode($returnInfo);