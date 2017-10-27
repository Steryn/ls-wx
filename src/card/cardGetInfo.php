<?php
    require_once 'cardApi.php';
    
    // 查询卡券详情
    $result = json_encode($_POST['getInfo'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $wx->wxCardGetInfo($result);
    echo json_encode($returnInfo);
    // yes