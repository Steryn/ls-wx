<?php
    /****************************************************
    *  修改客服帐号
    ****************************************************/
    require_once 'customServiceApi.php';

    $result = json_encode($_POST['kfaccountUpdate'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $custom->kfaccountUpdate($result);
    echo json_encode($returnInfo);