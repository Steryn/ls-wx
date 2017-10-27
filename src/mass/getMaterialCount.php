<?php
    /****************************************************
    *  获取素材总数
    ****************************************************/
    require_once 'massApi.php';

    // $result = json_encode($_POST['deleteMass'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $mass->getMaterialCount();
    echo json_encode($returnInfo);