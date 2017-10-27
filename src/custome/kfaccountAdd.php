<?php
    /****************************************************
    *  添加客服帐号
    ****************************************************/
    require_once 'customServiceApi.php';

    $result = json_encode($_POST['kfaccountAdd'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $custom->kfaccountAdd($result);
    echo json_encode($returnInfo);