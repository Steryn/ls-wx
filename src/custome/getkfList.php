<?php
    /****************************************************
    *  获取所有客服账号
    ****************************************************/
    require_once 'customServiceApi.php';

    // $result = json_encode($_POST['getkfList'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $custom->getkfList();
    echo json_encode($returnInfo);