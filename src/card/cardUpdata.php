<?php
    require_once 'cardApi.php';
    
    // 微信卡券：更改卡券信息接口
    $result = json_encode($_POST['update'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $wx->wxCardUpdate($result);
    echo json_encode($returnInfo);
    // yes