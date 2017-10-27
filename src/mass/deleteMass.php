<?php
    /****************************************************
    *  删除群发【群发只有在刚发出的半小时内可以删除】
    ****************************************************/
    require_once 'massApi.php';

    $result = json_encode($_POST['deleteMass'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $mass->deleteMass($result);
    echo json_encode($returnInfo);