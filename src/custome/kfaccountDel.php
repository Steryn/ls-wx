<?php
    /****************************************************
    *  删除客服帐号
    ****************************************************/
    require_once 'customServiceApi.php';

    $result = json_encode($_POST['kfaccountDel'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $custom->kfaccountDel($result);
    echo json_encode($returnInfo);