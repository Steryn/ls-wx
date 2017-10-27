<?php
    require_once 'cardApi.php';
    
    // 微信卡券：批量查询卡券详情
    $result = json_encode($_POST['batchget'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $wx->wxCardBatchget($result);
    echo json_encode($returnInfo);
    // yes