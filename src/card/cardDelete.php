<?php
    require_once 'cardApi.php';
    
    // 删除卡券
    $result = json_encode($_POST['cardDelete'],JSON_UNESCAPED_UNICODE);
    $returnInfo = $wx->wxCardDelete($result);
    echo json_encode($returnInfo);
    // no