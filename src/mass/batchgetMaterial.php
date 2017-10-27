<?php
    /****************************************************
    *  获取素材总数
    ****************************************************/
    require_once 'massApi.php';

    $result = json_encode($_POST['batchgetMaterial'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $mass->batchgetMaterial();
    echo json_encode($returnInfo);