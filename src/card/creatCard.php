<?php
    require_once 'cardApi.php';

    // 创建卡券信息
    $result = json_encode($_POST['cardId'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $wx->wxCardCreated($result);
    echo json_encode($returnInfo);
    // yes