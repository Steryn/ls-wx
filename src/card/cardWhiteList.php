<?php
    require_once 'cardApi.php';

    // 设置测试白名单
    $result = json_encode($_POST['whiteList'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $wx->wxCardWhiteList($result);
    echo json_encode($returnInfo);
    // yes