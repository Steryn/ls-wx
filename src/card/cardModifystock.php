<?php
    require_once 'cardApi.php';
    
    // 微信卡券：修改库存接口
    $result = json_encode($_POST['modifystock'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $wx->wxModifystock($result);
    echo json_encode($returnInfo);
    // yes