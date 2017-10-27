<?php
    require_once 'cardApi.php';
    
    // 查询导入code数目接口
    $result = json_encode($_POST['cardCode'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $wx->wxCardCodeNum($result);
    echo json_encode($returnInfo);
    // yes