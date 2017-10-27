<?php
    require_once 'cardApi.php';

    // 拉取卡券概况数据接口
    $result = json_encode($_POST['getcardbizuininfo'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $wx->wxGetcardbizuininfo($result);
    echo json_encode($returnInfo);
    // yes